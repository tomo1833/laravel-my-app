<script setup lang="ts">
const sendMessage = async () => {
    if (!message.value) return;
    try {
        const response = await fetch("/chatgpt", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ message: message.value }),
        });
        if (!response.ok) throw new Error("Network response was not ok.");
        const data = await response.json();
        chatMessages.value.push({
            role: "gpt",
            content: data.choices[0].message.content,
        });
        message.value = "";
    } catch (error) {
        console.error("There was a problem with the fetch operation:", error);
    }
};
</script>

<template>
    <div class="container">
        <h1>ChatGPTとのチャット</h1>
        <div
            id="chatContainer"
            style="
                margin-bottom: 20px;
                border: 1px solid #ccc;
                padding: 10px;
                height: 300px;
                overflow-y: scroll;
            "
        >
            <div
                v-for="msg in chatMessages"
                :key="msg.content"
                class="message"
                :class="{
                    'user-message': msg.role === 'user',
                    'gpt-message': msg.role === 'gpt',
                }"
            >
                {{ msg.role }}: {{ msg.content }}
            </div>
        </div>
        <form @submit.prevent="sendMessage">
            <input
                v-model="message"
                type="text"
                class="form-control"
                placeholder="メッセージを入力..."
                required
            />
            <button type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>
</template>
