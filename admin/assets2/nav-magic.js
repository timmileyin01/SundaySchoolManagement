

const li1 = document.getElementById('li1');
const li2 = document.getElementById('li2');
const li3 = document.getElementById('li3');
const li4 = document.getElementById('li4');
const li5 = document.getElementById('li5');



const dashboard = document.body.classList.contains('dashboard');
const lessons = document.body.classList.contains('lessons');
const categories = document.body.classList.contains('categories');
const users = document.body.classList.contains('users');
const settings = document.body.classList.contains('settings');





if (dashboard) {
    
    li1.classList.add('active');
    li2.classList.remove('active');
    li3.classList.remove('active');
    li4.classList.remove('active');
    li5.classList.remove('active');
}

if(lessons) {
    li1.classList.remove('active');
    li2.classList.add('active');
    li3.classList.remove('active');
    li4.classList.remove('active');
    li5.classList.remove('active');
}
if(categories) {
    li1.classList.remove('active');
    li2.classList.remove('active');
    li3.classList.add('active');
    li4.classList.remove('active');
    li5.classList.remove('active');
}
if(users) {
    li1.classList.remove('active');
    li2.classList.remove('active');
    li3.classList.remove('active');
    li4.classList.add('active');
    li5.classList.remove('active');
}
if(settings) {
    li1.classList.remove('active');
    li2.classList.remove('active');
    li3.classList.remove('active');
    li4.classList.remove('active');
    li5.classList.add('active');
}




/*
const pool = document.body.classList.contains('dashboard');

alert(pool);

*/








