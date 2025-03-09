let collapseBtn = document.getElementById('collapse-btn');
let uncollapseBtn = document.getElementById('uncollapse-btn');

collapseBtn.addEventListener('click', function(){
    let navbar = document.getElementById('navbar-collapse');

    navbar.classList.add('active');
});

uncollapseBtn.addEventListener('click', function(){
    let navbar = document.getElementById('navbar-collapse');

    navbar.classList.remove('active');
});
