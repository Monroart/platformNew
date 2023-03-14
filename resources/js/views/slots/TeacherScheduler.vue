<template>
    <div class="col-md-9">
        <div class="container">
            <div class="timetable-img text-center">
                <img src="img/content/timetable.png" alt="">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr class="bg-light-gray">
                        <th>Time
                        </th>
                        <th v-for="(e, i) in 7">
                            <p>{{ weekDays[i] }}</p>
                            <p>{{ weekDaysString[i] }}</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="interval in periods" :key="interval.id">
                        <td class="align-middle">{{ interval.period }}</td>
                        <td v-for="(day, number) in weekDaysTable" :key="day">
<!--                            <span-->
<!--                              class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"-->
<!--                              @click="getSlot(day, interval.id)"-->
<!--                            >-->
<!--                              Открыть-->
<!--                            </span>-->
<!--                          Ничего не выбрано-->
                            <span
                              class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size13 xs-font-size13"
                              :class="{
                                'bg-sky': !getSlot(number, interval.id),
                                'bg-green': getSlot(number, interval.id) && getSlot(number, interval.id)['type'] === 'open',
                                'bg-yellow': getSlot(number, interval.id) && getSlot(number, interval.id)['type'] === 'can',
                                'bg-orange': getSlot(number, interval.id) && getSlot(number, interval.id)['type'] === 'lesson'
                              }"
                              :ref="'column' + day + interval.id"
                              id="dropdownMenuButton1"
                              data-bs-toggle="dropdown"
                              data-bs-auto-close="outside"
                              aria-expanded="false"
                              @mouseenter="setHover(day, interval.id)"
                              @mouseleave="unsetHover(day, interval.id)"
                            >
                              {{ getButtonText(number, interval.id) }}
                            </span>

                          <ul
                            class="dropdown-menu bg-light-gray shadow-hover"
                            aria-labelledby="dropdownMenuButton1"
                            ref="dropdown"
                          >
                              <li class="dropdown-item text-center">
                                <button
                                  @click="saveToSchedule(number, interval.id, 'open')"
                                  class="btn btn-sm btn-blue-soft">
                                  Открыть слот
                                </button>
                              </li>

                              <li class="dropdown-item text-center">
                                <button
                                  @click="saveToSchedule(number, interval.id, 'can')"
                                  class="btn btn-sm btn-blue-soft">
                                  Готовность подменить
                                </button>
                              </li>

                              <li v-if="showLessonMenu" class="dropdown-item text-center">
                                <select class="form-select" aria-label="Default select example">
                                  <option value="false" selected>Выберите курс</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                              </li>

                              <li class="dropdown-item text-center">
                                <button v-if="!showLessonMenu" class="btn btn-sm btn-blue-soft" @click="showLessonMenu = true">
                                  Урок
                                </button>

                                <button v-if="showLessonMenu" class="btn btn-sm btn-blue-soft" @click="showLessonMenu = true">
                                  Сохранить
                                </button>
                              </li>

                            <li class="dropdown-item text-center">
                              <button class="btn btn-sm btn-warning">
                                Закрыть слот
                              </button>
                            </li>
                          </ul>
<!--                          ничего не выбрано-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            weekDays: [],
            weekDaysString: [
                "Понедельник",
                "Вторник",
                "Среда",
                "Четверг",
                "Пятница",
                "Суббота",
                "Воскресенье",
            ],
            shortWeekDaysString: ["пн", "вт", "ср", "чт", "пт", "сб", "вс"],
            weekDaysTable: ["mon", "tue", "wed", "thu", "fri", "sat", "sun"],
            periods: [],
            slots: [],
            showLessonMenu: false,
            hoverClass: '',
        }
    },

    methods: {
      loadSlots() {
        axios.post('api/slots/get')
          .then((res) => {
            this.periods = res.data.periods
            this.slots = res.data.slots
          })
      },

      saveToSchedule(day, interval_id, type) {
        this.$refs.dropdown.forEach((i) => {
          i.classList.remove('show')
        })
        this.showLessonMenu = false
        axios.post('api/slots/set', {
          slot: {
            day, interval_id, type
          }
        })

        this.loadSlots()
      },

      getSlot(day, period_id) {
        return this.slots.find(i => i.day_of_the_week === day && i.period_id === period_id)
      },

      setHover(day, period_id) {
        let name = 'column' + day + period_id
        this.$refs[name][0].classList.add('hover-opacity')
      },

      unsetHover(day, period_id) {
        let name = 'column' + day + period_id
        this.$refs[name][0].classList.remove('hover-opacity')
      },

      getButtonText(day, period_id) {
        let slot = this.getSlot(day, period_id)

        if (!slot)
          return 'Free'
        else if (slot.type === 'open')
          return 'Открыт'
        else if (slot.type === 'can')
          return 'Подхват'
        else if (slot.type === 'lesson') {
          return 'Хз'
        }

      }
    },
    created() {

    },

    mounted() {
      this.loadSlots()
    }
}
</script>

<style scoped>
.bg-light-gray {
    background-color: #f7f7f7;
}
.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}


.bg-sky.box-shadow {
    box-shadow: 0px 5px 0px 0px #00a2a7
}

.bg-orange.box-shadow {
    box-shadow: 0px 5px 0px 0px #af4305
}

.bg-green.box-shadow {
    box-shadow: 0px 5px 0px 0px #4ca520
}

.bg-yellow.box-shadow {
    box-shadow: 0px 5px 0px 0px #dcbf02
}

.bg-pink.box-shadow {
    box-shadow: 0px 5px 0px 0px #e82d8b
}

.bg-purple.box-shadow {
    box-shadow: 0px 5px 0px 0px #8343e8
}

.bg-lightred.box-shadow {
    box-shadow: 0px 5px 0px 0px #d84213
}


.bg-sky {
    background-color: #02c2c7
}

.bg-orange {
    background-color: #e95601
}

.bg-green {
    background-color: #5bbd2a
}

.bg-yellow {
    background-color: #f0d001
}

.bg-pink {
    background-color: #ff48a4
}

.bg-purple {
    background-color: #9d60ff
}

.bg-lightred {
    background-color: #ff5722
}

.padding-15px-lr {
    padding-left: 15px;
    padding-right: 15px;
}
.padding-5px-tb {
    padding-top: 5px;
    padding-bottom: 5px;
}
.margin-10px-bottom {
    margin-bottom: 10px;
}
.border-radius-5 {
    border-radius: 5px;
}

.margin-10px-top {
    margin-top: 10px;
}
.font-size14 {
    font-size: 14px;
}

.text-light-gray {
    color: #d6d5d5;
}
.font-size13 {
    font-size: 13px;
}

.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.hover-opacity {
  opacity: 0.6  ;
}

</style>
