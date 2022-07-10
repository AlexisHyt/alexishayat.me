const projects_wrapper = document.querySelector('.projects_wrapper');
const projects = document.querySelectorAll('.project_wrapper');


const vH = window.innerHeight;
const h_center = vH / 10;

function adjustProjects(project){
    const projectBounds = project.getBoundingClientRect();
    const projectTop = projectBounds.top;

    const diff = Math.abs(projectTop - h_center);
    let percent = (100 * diff) / vH;

    if(percent > 90){
        percent = 90;
    }

    const div = project.querySelector('.project');
    div.style.transform = 'scale(' + ( 1 - (percent / 300) ) + ')';
    div.style.opacity = (1 - (percent / 100)) + '';
}

projects.forEach((project) => {
    adjustProjects(project);
});
projects_wrapper.addEventListener('scroll', (e) => {
    projects.forEach((project) => {
        adjustProjects(project);
    });
});
document.addEventListener('scroll', (e) => {
    projects.forEach((project) => {
        adjustProjects(project);
    });
});
