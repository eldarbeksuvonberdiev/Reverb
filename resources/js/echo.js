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

const echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Real vaqt yangilanishlarini tinglash
echo.private('notification')
    .listen('NotificationEvent', (data) => {
        console.log(data);
        const messageCountElement = document.getElementById('message-count');
        const dropdown = document.getElementById('messages-dropdown');

        // Xabarlar sonini yangilash
        messageCountElement.textContent = data.messageCount;

        // Dropdownni yangilash
        dropdown.innerHTML = '';
        if (data.messages.length > 0) {
            data.messages.forEach(message => {
                dropdown.innerHTML += `
                        <a href="/read-message/${message.id}" class="dropdown-item">
                            <div class="media">
                                <img src="${message.image}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        ${message.created_at}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">${message.text}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${message.timeAgo}</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    `;
            });
        } else {
            dropdown.innerHTML = '<a href="#" class="dropdown-item">No data</a>';
        }

        dropdown.innerHTML += '<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>';
    });

