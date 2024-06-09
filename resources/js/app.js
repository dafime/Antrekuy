// require('./bootstrap');

// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyCkJSu_DjRDMRb3qbMOhz91DUrLBCX2fIQ",
    authDomain: "antrekuy-423802.firebaseapp.com",
    projectId: "antrekuy-423802",
    storageBucket: "antrekuy-423802.appspot.com",
    messagingSenderId: "777037318776",
    appId: "1:777037318776:web:5ac9ac9c533e27e2fe3b8d",
    measurementId: "G-V5XJP67TTJ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);
const analytics = getAnalytics(app);

onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
    alert("notifikasi terbaru");
    // ...
});


// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
getToken(messaging, { vapidKey: 'BJW9Oiw8UcAcIsjFQGj4_297hOHFUffrjxPMkqJM3wlYXzVB5y_gWsYycFzD05BS5PZL-t2ivKb4uHFs5nCwRKc' }).then((currentToken) => {
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        // ...
        console.log(currentToken);
    } else {
        // Show permission request UI
        requestPermission();
        console.log('No registration token available. Request permission to generate one.');
        // ...
    }
}).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
});

// [START messaging_request_permission_modular]
function requestPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
            // TODO(developer): Retrieve a registration token for use with FCM.
            // ...
        } else {
            alert("Silahkan mengaktifkan izin notifikasi untuk mendapat notifikasi terbaru dari kami. ");
        }
    });
}
// [END messaging_request_permission_modular]
