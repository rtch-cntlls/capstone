document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleSidebar');
    if(window.innerWidth <= 768){
        document.body.classList.add('sidebar-hidden');
    }

    if(localStorage.getItem('sidebar-hidden') === 'true'){
        document.body.classList.add('sidebar-hidden');
    }

    if(toggleBtn){
        toggleBtn.addEventListener('click', function(){
            document.body.classList.toggle('sidebar-hidden');
            localStorage.setItem('sidebar-hidden', document.body.classList.contains('sidebar-hidden'));
        });
    }
    window.addEventListener('resize', function(){
        if(window.innerWidth > 768){
            document.body.classList.remove('sidebar-hidden');
        } else {
            document.body.classList.add('sidebar-hidden');
        }
    });
});
