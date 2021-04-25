<template>
  <div class="wrapper">
    <div class="guide">
      <p>Информация о сотрудниках</p>
      <div v-if="data">
        <div class="guide-info" v-for="(item) in data" :key="item">
          <div class="person-name">Сотрудник: {{item.name}}</div>
          <div class="department">Отдел: {{item.department}}</div>
          <div class="phone">Номер телефона: {{item.phone}}</div>
          <div class="exp">Стаж работы: {{item.exp}}</div>
        </div>
      </div>
      <div v-if="data !== null && data.length === 0">Сотрудник не найден</div>
    </div>
    <div class="forms">
      <div class="filter-form">
        <p>Поиск сотрудника</p>
        <form action="" @submit.prevent="fetchData" >
          <div class="filter-block-area">
            <input id='name' type="text" name="name" v-model="name">
            <label for="name">Введите имя</label>
          </div>

          <div class="filter-block-area">
            <input id="phone" type="text" name="phone" v-model="phone">
            <label for="phone">Введите телефон</label>
          </div>

          <div class="filter-block-area">
            <select name="department" id="depart" v-model="department">
              <option disabled value="">Выберите отдел</option>
              <option value="Финансовый отдел">Финансовый отдел</option>
              <option value="Экономический отдел">Экономический отдел</option>
              <option value="Отдел информационных технологий">Отдел информационных технологий</option>
            </select>
          </div>
          <input type="submit" value="Поиск">
        </form>
        <button class="showAll" @click="showAll">{{isShowAll ? 'Скрыть' : 'Показать всех'}}</button>
      </div>
      <div class="add-form">
        <p>Добавить сотрудника</p>
        <form action="" @submit.prevent="fetchAddData">
          <div class="add-block-area">
            <input id="addName" type="text" v-model="addName">
            <label for="addName">Введите Имя</label>
          </div>
          <div class="add-block-area">
            <input id="addPhone" type="number" v-model="addPhone">
            <label for="addPhone">Введите номер</label>
          </div>
          <div class="add-block-area">
            <input id="addExp" type="text" v-model="addExp">
            <label for="addExp">Введите стаж</label>
          </div>
          <div class="add-block-area">
            <select name="department" v-model="addDepartment">
              <option disabled value="">Выберите отдел</option>
              <option value="Финансовый отдел">Финансовый отдел</option>
              <option value="Экономический отдел">Экономический отдел</option>
              <option value="Отдел информационных технологий">Отдел информационных технологий</option>
            </select>
          </div>
          <input type="submit" value="Добавить">
        </form>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'App',
  data() {
    return {
      name: '',
      department: '',
      phone: '',
      data: null,
      addName: '',
      addDepartment: '',
      addPhone: null,
      addExp: '',
      isShowAll: false
    }
  },
  methods: {
    showAll() {
      this.isShowAll = !this.isShowAll;
      if(this.isShowAll){
        fetch(`./api/get-data.php`)
          .then(resp => resp.json())
          .then(data => this.data = data);
      }else{
        this.data = null;
      }

    },
    fetchData() {
      if(!this.name || !this.department || !this.phone){
        alert('Заполните все поля для поиска');
        return;
      }
      const { name, department, phone } = this;
      if (name || department || phone) {
        fetch(`./api/get-data.php?name=${name}&department=${department}&phone=${phone}`)
          .then(resp => resp.json())
          .then(data => this.data = data);
      }
      else {
        this.data = null;
      }
    },
    fetchAddData: function () {
      console.log(typeof +this.addPhone)
      if (!this.addName || !this.addDepartment || !this.addExp || !this.addPhone) {
        alert('Заполните все поля для добавления');
        return;
      }
      fetch('./api/set-data.php', {
        method: 'POST',
        body: JSON.stringify({
          name: this.addName,
          department: this.addDepartment,
          phone: this.addPhone,
          exp: this.addExp
        })
      })
        .then(() => {
          alert('Сотрудник добавлен')
          this.addName = '';
          this.addDepartment = '';
          this.addPhone = '';
          this.addExp = '';
        });
    }
  },
}
</script>

<style src="./style.css"></style>
