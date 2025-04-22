<script setup>
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';


const name = ref('')
const email = ref('')
const phone = ref('')
const date = ref('')
const status = ref('')
const router = useRouter()
const route = useRoute()




async function updUser() {
    const response = await fetch(`http://127.0.0.1:8000/client/${route.params.id}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            name: name.value,
            email: email.value,
            phone: phone.value,
            date: date.value,
            status: status.value
        })
    });

    if (response.ok) {
        router.push('/')
    } else {
        const error = await response.json()
        alert('Ошибка обновления: ' + JSON.stringify(error.errors || error.message))
    }

}
</script>

<template>
    <div class="form-container">
        <h2>Обновить информацию пользователя</h2>
        <form @submit.prevent="updUser">
            <div class="form-group">
                <label>ФИО:</label>
                <input type="text"  v-model="name">
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email"  v-model="email">
            </div>

            <div class="form-group">
                <label>Телефон:</label>
                <input type="text"  v-model="phone">
            </div>

            <div class="form-group">
                <label>Дата регистрации:</label>
                <input type="date"  v-model="date">
            </div>

            <div class="form-group">
                <label>Статус:</label>
                <select  v-model="status">
                    <option value="1">Активен</option>
                    <option value="0">Неактивен</option>
                </select>
            </div>

            <button type="submit" class="btn-blue">Сохранить</button>
        </form>
    </div>
    
</template>

<style scoped>
.form-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 420px;
    margin: 0 auto;
    align-items: center;
    margin-top: 10%;
}

.form-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input,
.form-group select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-blue {
    background-color: #3490dc;
    color: white;
    border: none;
    padding: 10px 15px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
}

.btn-blue:hover {
    background-color: #2779bd;
}
</style>