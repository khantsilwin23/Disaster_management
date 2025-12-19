@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-header bg-success text-white fw-semibold">
                <i class="fas fa-robot me-2"></i> Disaster AI Chat Bot
            </div>
            <div class="card-body" id="chat-container" style="height: 400px; overflow-y: auto;">
                <div id="messages" class="d-flex flex-column gap-2"></div>
            </div>
            <div class="card-footer">
                <form id="chat-form" class="d-flex">
                    @csrf
                    <input type="text" id="message" name="message" class="form-control me-2 rounded-pill"
                        placeholder="Type your message..." required>
                    <button type="submit" class="btn btn-success rounded-pill">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            let input = document.getElementById('message');
            let userMessage = input.value;

            // Add user message
            document.getElementById('messages').innerHTML += `
                <div class="text-end">
                    <span class="badge bg-primary">${userMessage}</span>
                </div>`;

            input.value = '';

            // Send to server
            let response = await fetch("{{ route('chatbot.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    message: userMessage
                })
            });
            let data = await response.json();

            // Add bot reply
            document.getElementById('messages').innerHTML += `
                <div class="text-start">
                    <span class="badge bg-secondary">${data.reply.replace(/\n/g, '<br>')}</span>
                </div>`;

            // Scroll to bottom
            let chatContainer = document.getElementById('chat-container');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    </script>
@endsection
