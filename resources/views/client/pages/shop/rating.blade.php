<script>
    document.addEventListener('DOMContentLoaded', function () {
        const descEl = document.getElementById('productDescription');
        const toggleEl = document.getElementById('toggleDescription');
    
        if (!descEl || !toggleEl) return;
    
        const fullText = `{{ addslashes($product->description) }}`;
        const shortText = fullText.length > 100 ? fullText.substring(0, 100) + '...' : fullText;
    
        let isFull = false;
    
        toggleEl.addEventListener('click', function () {
            if (isFull) {
                descEl.textContent = shortText;
                toggleEl.textContent = 'See more';
            } else {
                descEl.textContent = fullText;
                toggleEl.textContent = 'See less';
            }
            isFull = !isFull;
        });
    });
    const reviewsApi = `{{ route('shop.reviews.index', $product->product_id) }}`;
    const reviewsList = document.getElementById('reviewsList');
    const filterButtons = document.querySelectorAll('.filter-btn');
    let withComments = false;
    let activeStars = '';
    let showAllReviews = false;

    function renderReviews(data){
    reviewsList.innerHTML = '';
    const items = data.reviews.data || [];
    if(items.length === 0){
        reviewsList.innerHTML = '<div class="text-muted">No reviews yet.</div>';
        return;
    }

    const displayedItems = showAllReviews ? items : items.slice(0, 1);

        displayedItems.forEach(r => {
            const name = r.customer?.user 
                ? `${r.customer.user.firstname ? r.customer.user.firstname[0] + '*****' : ''} \
                ${r.customer.user.lastname ? r.customer.user.lastname[0] + '*****' : ''}`.trim()
                    : 'Customer';

            function renderStars(rating) {
                let html = '';
                for (let i = 1; i <= 5; i++) {
                    html += i <= rating 
                        ? '<i class="fas fa-star text-warning"></i> ' 
                        : '<i class="far fa-star text-muted"></i> ';
                }
                return html;
            }

            const stars = renderStars(r.rating);
            
            const imgs = (r.images || []).map(u => 
                `<img src="${u.startsWith('http') ? u : ('<?= asset('storage/') ?>'+'/'+u) }" class="rounded me-2 mb-2" style="width:70px;height:70px;object-fit:cover;">`
            ).join('');
            const replies = (r.replies || []).map(rep => 
                `<div class="ms-3 mt-2 p-2 bg-light rounded small"><strong>Admin:</strong> ${rep.comment}</div>`
            ).join('');

            const card = document.createElement('div');
            card.className = 'card border-0 shadow-sm';
            card.innerHTML = `<div class="card-body">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset("storage/profile/customer.webp") }}" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                    <div class="fw-semibold">${name}</div>
                    <div class="text-warning ms-auto">${stars}</div>
                </div>
                ${r.comment ? `<div class="mx-3">${r.comment}</div>` : ''}
                ${imgs ? `<div class="mt-2">${imgs}</div>` : ''}
                ${replies}
            </div>`;
            reviewsList.appendChild(card);
        });

        if(items.length > 1){
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'btn btn-link p-0 mt-2';
            toggleBtn.textContent = showAllReviews ? 'Show Less' : `Show All (${items.length})`;
            toggleBtn.addEventListener('click', ()=>{
                showAllReviews = !showAllReviews;
                renderReviews(data);
            });
            reviewsList.appendChild(toggleBtn);
        }
    }

    async function loadReviews(){
        const params = new URLSearchParams();
        if(activeStars) params.append('stars', activeStars);
        if(withComments) params.append('with_comments', '1');
        
        const res = await fetch(`${reviewsApi}?${params.toString()}`);
        const json = await res.json();
        renderReviews(json);
    }

    filterButtons.forEach(btn=>{
        btn.addEventListener('click', ()=>{
            activeStars = btn.dataset.stars;
            loadReviews();
        });
    });
    const btnWithComments = document.getElementById('btnWithComments');
    if(btnWithComments){ btnWithComments.addEventListener('click', ()=>{ withComments = !withComments; btnWithComments.classList.toggle('btn-secondary'); loadReviews(); }); }

    loadReviews();

    const starPicker = document.getElementById('starPicker');
    const ratingValue = document.getElementById('ratingValue');
    if(starPicker){
        starPicker.querySelectorAll('.star').forEach(btn=>{
            btn.addEventListener('click', ()=>{
                ratingValue.value = btn.dataset.value;
                starPicker.querySelectorAll('.star').forEach(b=>b.classList.remove('btn-warning'));
                btn.classList.add('btn-warning');
            });
        });
    }

    const submitBtn = document.getElementById('submitReviewBtn');
    if(submitBtn){
        submitBtn.addEventListener('click', async ()=>{
            const form = document.getElementById('reviewForm');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const payload = {
                order_item_id: form.order_item_id.value,
                rating: form.rating.value,
                comment: form.comment.value
            };
            const res = await fetch(`{{ route('shop.reviews.store') }}`,{
                method:'POST',
                headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify(payload)
            });
            if(res.ok){
                loadReviews();
                const modalEl = document.getElementById('reviewModal');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal?.hide();
                const alertBox = document.getElementById('reviewAlert');
                if (alertBox) { alertBox.classList.remove('d-none'); alertBox.textContent = 'Commented successfully.'; }
            } else {
                alert('Failed to submit review');
            }
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('rate') === '1') {
        const modalEl = document.getElementById('reviewModal');
        if (modalEl) {
            const m = new bootstrap.Modal(modalEl);
            m.show();
        }
    }
</script>