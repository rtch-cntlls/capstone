const filterBtn = document.getElementById('mobileFilterBtn');
const filterSidebar = document.getElementById('mobileFilterSidebar');
const closeBtn = document.getElementById('closeFilterSidebar');

filterBtn.addEventListener('click', () => {
    filterSidebar.classList.toggle('open');
});

closeBtn.addEventListener('click', () => {
    filterSidebar.classList.remove('open');
});