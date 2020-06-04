/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyDJXcfxyBvl1CGK9ArAPKkGpwu2rcNjf3I",
    authDomain: "hsi-ophthalmology.firebaseapp.com",
    databaseURL: "https://hsi-ophthalmology.firebaseio.com",
    projectId: "hsi-ophthalmology",
    storageBucket: "hsi-ophthalmology.appspot.com",
    messagingSenderId: "892523160631",
    appId: "1:892523160631:web:657db2ca63df242a3a8bb2",
    measurementId: "G-4NXRESMTJY"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
}); 