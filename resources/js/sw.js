self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications aren't supported or permission not granted!
        return;
    }

    if (e.data) {
        var msg = e.data.json();
        self.data = msg.data;
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions
        }));
    }
});

self.addEventListener('notificationclick', function (e) {
    e.notification.close();
    if (e.notification.actions && e.notification.actions[0].action === 'view_detail' && self.data && self.data.url) {
        self.clients.openWindow(self.data.url);
    } else {
        self.clients.openWindow('/');
    }
});