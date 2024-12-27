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
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
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

console.log(userName);
console.log(chatId);
console.log(toUser);
console.log(userId);

window.Echo.channel(`chat.${chatId}`)
    .listen('NewMessageEvent', (e) => {
        console.log('Received Event Data:', e);
        // console.log('File URL:', e.file);

        const messageList = document.getElementById('newMessage');
        const newMessage = document.createElement('h5');


        newMessage.innerHTML = `
        <strong style="color: red">
        ${e.sender_id == userId ? 'You' : toUser.name.charAt(0).toUpperCase() + toUser.name.slice(1)}
        : </strong>${e.message.msg}
        `;

        if (e.sender_id !== userId) {
            // messageList.appendChild(newMessage);
            messageList.append(newMessage);
        }
    });
// let filePreview = '';

// if (e.file) {
//     const extension = e.file.split('.').pop().toLowerCase();
//     if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
//         filePreview = `<img src="${e.file}" alt="Image" width="200px" style="margin-top: 5px;">`;
//     } else if (['mp4', 'webm', 'ogg'].includes(extension)) {
//         filePreview = `
//                 <video width="200px" controls style="margin-top: 5px;">
//                     <source src="${e.file}" type="video/${extension}">
//                     Your browser does not support the video tag.
//                 </video>`;
//     } else if (['mp3'].includes(extension)) {
//         filePreview = `
//                 <audio controls style="margin-top: 5px;">
//                     <source src="${e.file}" type="audio/${extension}">
//                     Your browser does not support the audio tag.
//                 </audio>`;
//     } else if (['txt', 'pdf', 'doc', 'docx'].includes(extension)) {
//         filePreview = `<a href="${e.file}" target="_blank" style="color: #007bff; font-weight: bold; margin-top: 5px;">Download File</a>`;
//     } else {
//         filePreview = `<a href="${e.file}" target="_blank" style="color: #007bff; font-weight: bold; margin-top: 5px;">Download File</a>`;
//     }
// }
// <li style="padding: 10px; border-bottom: 1px solid #e0e0e0">
//     <span class="text-primary" style="font-weight: bold">${e.sender}:</span>
//     <span>${e.text}</span>
// </li>

// window.Echo.channel('newUser')
//     .listen('NewUserEvent', (e) => {
//         console.log('New user registered:', e);
//         const userList = document.getElementById('userList');
//         const newUser = document.createElement('li');
//         newUser.classList.add('list-group-item');
//         const userProfileUrl = `/show/${e.id}`;
//         newUser.innerHTML = `<a href="${userProfileUrl}">${e.name}</a>`;
//         userList.prepend(newUser);
//     });
