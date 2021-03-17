//SIDEBAR OPEN AND CLOSE
let sidebar = document.getElementById('sidebar');
let toggle_btn = document.getElementById('toggle_btn');

toggle_btn.addEventListener('click', e => {
    e.preventDefault();
    sidebar.classList.toggle('sidebar_active');
    toggle_btn.classList.toggle('toggle_btn_active');
});

//OPTIONS CLOSED AND CLOSE

let projectsBtn = document.getElementById('projectsBtn');
let reportsBtn = document.getElementById('reportsBtn');
let projectsList = document.getElementById('projectsList');
let reportsList = document.getElementById('reportsList');

    //Open/Close Projects
projectsBtn.addEventListener('click', e => {
    e.preventDefault();
    projectsList.classList.toggle('closed');
    if(projectsBtn.firstElementChild.classList.contains('fa-chevron-down')){
        projectsBtn.firstElementChild.classList.remove('fa-chevron-down');
        projectsBtn.firstElementChild.classList.add('fa-chevron-right');
    } else {
        projectsBtn.firstElementChild.classList.remove('fa-chevron-right');
        projectsBtn.firstElementChild.classList.add('fa-chevron-down');
    }
})

    //Open/Close Reports
reportsBtn.addEventListener('click', e => {
    e.preventDefault();
    reportsList.classList.toggle('closed');
    if(reportsBtn.firstElementChild.classList.contains('fa-chevron-down')){
        reportsBtn.firstElementChild.classList.remove('fa-chevron-down');
        reportsBtn.firstElementChild.classList.add('fa-chevron-right');
    } else {
        reportsBtn.firstElementChild.classList.remove('fa-chevron-right');
        reportsBtn.firstElementChild.classList.add('fa-chevron-down');
    }
})


