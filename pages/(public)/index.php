<div class="w-full max-w-md bg-neutral-light shadow-2xl rounded-xl flex flex-col h-[90vh] overflow-hidden">
  
  <!-- Header -->
  <div class="bg-brand-primary text-white px-4 py-3 font-semibold text-lg">
    Chat
  </div>

  <!-- User Input -->
  <div class="bg-page p-3 flex flex-col gap-2">
    <input
      type="text"
      id="sender"
      placeholder="Your Username"
      class="px-3 py-2 rounded-md border border-brand-primary focus:outline-none focus:ring-2 focus:ring-brand-primary"
    />
    <input
      type="text"
      id="receiver"
      placeholder="Receiver Username"
      class="px-3 py-2 rounded-md border border-brand-primary focus:outline-none focus:ring-2 focus:ring-brand-primary"
    />
  </div>

  <!-- Chat Box -->
  <div id="chat-box" class="flex-1 overflow-auto px-4 py-2 space-y-2 bg-neutral-light text-sm text-neutral-dark">
    <!-- Messages will appear here -->
  </div>

  <!-- Message Input -->
  <div class="p-3 flex gap-2 border-t border-brand-secondary">
    <input
      type="text"
      id="message"
      placeholder="Type a message..."
      class="flex-1 px-4 py-2 rounded-full border border-brand-primary focus:outline-none focus:ring-2 focus:ring-brand-primary"
    />
    <button
      onclick="sendMessage()"
      class="bg-brand-primary hover:bg-brand-secondary text-white px-4 py-2 rounded-full transition"
    >
      Send
    </button>
  </div>
</div>

  <script>
    const ws = new WebSocket("ws://192.168.1.5:2346"); 

    ws.onopen = () => {
      console.log("Connected to WebSocket");
    };

ws.onmessage = (event) => {
  const data = JSON.parse(event.data);
  const currentUser = document.getElementById("sender").value;

  // Show only messages where I'm the sender or receiver
  if (data.sender !== currentUser && data.receiver !== currentUser) return;

  const isSelf = data.sender === currentUser;
  const align = isSelf ? 'justify-end' : 'justify-start';
  const bg = isSelf ? 'bg-red-500 text-white' : 'bg-neutral-200 text-black';

  const chatBox = document.getElementById("chat-box");
  chatBox.innerHTML += `
    <div class="flex ${align}">
      <div class="max-w-[70%] px-4 py-2 rounded-lg ${bg}">
        ${data.message}
      </div>
    </div>
  `;
  chatBox.scrollTop = chatBox.scrollHeight;
};


    function sendMessage() {
      const sender = document.getElementById("sender").value;
      const receiver = document.getElementById("receiver").value;
      const message = document.getElementById("message").value;

      if (!sender || !receiver || !message) return;

      ws.send(JSON.stringify({ sender, receiver, message }));
      document.getElementById("message").value = "";
    }
  </script>
