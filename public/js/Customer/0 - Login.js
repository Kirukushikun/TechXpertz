// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-analytics.js";
import { getAuth, signInWithEmailAndPassword, GoogleAuthProvider, signInWithPopup} from "https://www.gstatic.com/firebasejs/10.12.5/firebase-auth.js";

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
const provider = new GoogleAuthProvider();
const analytics = getAnalytics(app);


const submit = document.getElementById('submit');
submit.addEventListener("click", function(event){
    event.preventDefault();

    // Inputs
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;  

    signInWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {
        // Signed in 
        const user = userCredential.user;
        window.location.href = "/";
        // ... additional actions on successful sign-in
    })
    .catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        console.error("Error code:", errorCode, "Error message:", errorMessage);
        alert(errorMessage);
    });
});

// Google Sign-In Button Event
const google = document.getElementById('google-login');
google.addEventListener("click", function(){

    signInWithPopup(auth, provider)
    .then((result) => {
        // This gives you a Google Access Token. You can use it to access the Google API.
        const credential = GoogleAuthProvider.credentialFromResult(result);
        const token = credential.accessToken;
        // The signed-in user info.
        const user = result.user;
        window.location.href = "/";
        // IdP data available using getAdditionalUserInfo(result)
        // ...
    }).catch((error) => {
        // Handle Errors here.
        const errorCode = error.code;
        const errorMessage = error.message;
        // The email of the user's account used.
        const email = error.customData.email;
        // The AuthCredential type that was used.
        const credential = GoogleAuthProvider.credentialFromError(error);
        // ...
    });

});
