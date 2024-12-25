import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});


window.Echo.channel('message')
    .listen('MessageEvent', (e) => {
        console.log(e);
        const messageList = document.getElementById('messageList');
        const newMessage = document.createElement('li');
        const newImage = document.createElement('img');

        newMessage.innerText = e.message.text;

        newImage.src = e.message.image;
        newImage.alt = "New Image";
        messageList.prepend(newMessage, newImage);
    });



window.Echo.channel('employee')
    .listen('EmployeeEvent', (e) => {
        console.log(e);
        const messageList = document.getElementById('employeeList');
        const newMessage = document.createElement('tr');
        const newId = document.createElement('td');
        const newName = document.createElement('td');

        newId.innerText = e.message.id;
        newName.innerText = e.message.name;

        newMessage.appendChild(newId);
        newMessage.appendChild(newName);

        messageList.prepend(newMessage);
    });

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    forceTLS: false,
});

window.Echo.channel('message')
    .listen('ProductEvent', (e) => {
        console.log(e.message.messageCount);  // Bu yerda count qiymatini konsolga chiqarish
        const messageList = document.getElementById('messageList');

        if (!document.querySelector(`#message-${e.message.id}`)) {
            const li = document.createElement('li');
            li.id = `message-${e.message.id}`;
            li.classList.add('list-group-item');
            li.innerHTML = `
                <strong>${e.message.text}</strong><br>
                <img src="${e.message.image}" class="img-fluid mt-2" style="max-width: 100px;">
            `;
            messageList.appendChild(li);
        } else {
            console.log(`Duplicate message ignored: ${e.message.id}`);
        }

        const notificationCount = document.getElementById('notificationCount');
        const totalMessages = e.message.messageCount;

        // Console orqali `totalMessages` ni tekshirib chiqing
        console.log("Total messages: " + totalMessages);

        notificationCount.textContent = totalMessages;  // notificationCountni yangilash
    });

