<script setup lang="ts">
import { ref } from 'vue';
import { useRoute } from 'vue-router';


const list = ref({})
const router = useRoute()

const { id } = router.params
async function show() {
  const responce = await fetch('http://127.0.0.1:8000/client')
  if (responce.ok) {
    list.value = await responce.json()
  }
}

show()

async function delUser(id) {
  const responce = await fetch(`http://127.0.0.1:8000/client/${id}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
    }
  })
  if (responce.ok) {
    show()
  }
}
</script>

<template>
  <main>
    <div class="container">
      <h1>Управление данными</h1>

      <div class="action-buttons">
        <router-link to="/create" class="btn btn-primary">Добавить пользователя</router-link>
        <button class="btn btn-success">Экспорт в Excel</button>
      </div>

      <div class="search-container">
        <input type="text" class="search-box" placeholder="Поиск по таблице...">
      </div>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Телефон</th>
              <th>Дата регистрации</th>
              <th>Статус</th>
              <th>Действия</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="client in list" :key="client.id">
              <td>{{ client.id }}</td>
              <td>{{ client.name }}</td>
              <td>{{ client.email }}</td>
              <td>{{ client.phone }}</td>
              <td>{{ client.date }}</td>
              <td>
                <span :class="client.status ? 'status-active' : 'status-inactive'">
                  {{ client.status ? 'Активен' : 'Неактивен' }}
                </span>
              </td>
              <td>
                <button class="btn btn-primary" style="padding: 5px 10px;">Редактировать</button>
                <button class="btn btn-danger" style="padding: 5px 10px;" @click="delUser(client.id)">Удалить</button>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </main>
</template>

<style scoped>
/* Общие стили */
main {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 30px;
}

/* Стили для таблицы */
.table-container {
  overflow-x: auto;
  margin-bottom: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th,
td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #3498db;
  color: white;
  font-weight: bold;
  position: sticky;
  top: 0;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #e3f2fd;
}

.search-container {
  margin-bottom: 20px;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

.search-box {
  padding: 10px;
  width: 300px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 16px;
}

/* Стили для кнопок действий */
.action-buttons {
  margin-bottom: 20px;
  display: flex;
  gap: 10px;
}

.btn {
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s;
  text-decoration: none;
}

.btn-primary {
  background-color: #3498db;
  color: white;
}

.btn-primary:hover {
  background-color: #2980b9;
}

.btn-danger {
  background-color: #e74c3c;
  color: white;
}

.btn-danger:hover {
  background-color: #c0392b;
}

.btn-success {
  background-color: #2ecc71;
  color: white;
}

.btn-success:hover {
  background-color: #27ae60;
}

.status-active {
  color: green;
}

.status-inactive {
  color: red;
}
</style>
