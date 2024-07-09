document.addEventListener('DOMContentLoaded', function () {
    const loginBtn = document.getElementById('login-btn');
    const signupBtn = document.getElementById('signup-btn');
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');

    loginBtn.addEventListener('click', function () {
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';
        loginBtn.classList.add('active');
        signupBtn.classList.remove('active');
    });

    signupBtn.addEventListener('click', function () {
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';
        loginBtn.classList.remove('active');
        signupBtn.classList.add('active');
    });
});


document.addEventListener("DOMContentLoaded", function() {
    loadPosts();
    checkLogin();
});

function loadPosts() {
    fetch('load_posts.php')
        .then(response => response.json())
        .then(posts => {
            const feed = document.getElementById('feed');
            feed.innerHTML = '';

            posts.forEach(post => {
                const postElement = document.createElement('div');
                postElement.classList.add('post');

                let postContent = `
                    <h2>${post.student_id}</h2>
                    <p>${post.post_text}</p>
                `;

                if (post.post_image) {
                    postContent += `<img src="${post.post_image}" alt="Post Image">`;
                }

                postContent += `<button onclick="poke()">Poke</button>`;

                postElement.innerHTML = postContent;
                feed.appendChild(postElement);
            });
        });
}

function poke() {
    window.location.href = 'poke.html';
}

function checkLogin() {
    fetch('check_login.php')
        .then(response => response.json())
        .then(data => {
            if (data.logged_in) {
                showDialog('Welcome back!');
            }
        });
}

function showDialog(message) {
    const dialogBox = document.createElement('div');
    dialogBox.classList.add('dialog-box');
    dialogBox.innerHTML = `
        <p>${message}</p>
        <button onclick="closeDialog()">OK</button>
    `;

    const dialogOverlay = document.createElement('div');
    dialogOverlay.classList.add('dialog-overlay');

    document.body.appendChild(dialogBox);
    document.body.appendChild(dialogOverlay);

    dialogBox.classList.add('active');
    dialogOverlay.classList.add('active');
}

function closeDialog() {
    const dialogBox = document.querySelector('.dialog-box');
    const dialogOverlay = document.querySelector('.dialog-overlay');

    dialogBox.classList.remove('active');
    dialogOverlay.classList.remove('active');

    document.body.removeChild(dialogBox);
    document.body.removeChild(dialogOverlay);
}




