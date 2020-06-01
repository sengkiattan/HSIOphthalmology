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
    apiKey: "AIzaSyBlC6ciDj7wBbL3MTauSDpZkapAWVo4A0M",
    authDomain: "push-notification-test-f9fae.firebaseapp.com",
    databaseURL: "https://push-notification-test-f9fae.firebaseio.com",
    projectId: "push-notification-test-f9fae",
    storageBucket: "push-notification-test-f9fae.appspot.com",
    messagingSenderId: "554109460607",
    appId: "1:554109460607:web:5e1b60999b312c9da95f4a"
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