// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-analytics.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-auth.js";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyB_3JVgvXAM2YBGdr1aV9XQdkK6Pt4Kvdo",
    authDomain: "techxpertz-3ec73.firebaseapp.com",
    databaseURL: "https://techxpertz-3ec73-default-rtdb.firebaseio.com",
    projectId: "techxpertz-3ec73",
    storageBucket: "techxpertz-3ec73.appspot.com",
    messagingSenderId: "668116654277",
    appId: "1:668116654277:web:3a732e21d9b876693378ac",
    measurementId: "G-XS6EJ0P00C"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const analytics = getAnalytics(app);


const submit = document.getElementById('submit');
submit.addEventListener("click", function(event){
    event.preventDefault()

    // Inputs
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;  

    createUserWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {
        // Signed up 
        const user = userCredential.user;
        alert("Account Created")
        // ...
    })
    .catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        alert(errorMessage)
        // ..
    });
})