<template>
    <div id="app">
        <SpringCalendar year="2023" color="#1a3ca3" :events="events" locale="tet"/>
    </div>
</template>

<script>
import SpringCalendar from "vue-spring-calendar";
export default {
    name: "App",
    data: () => ({
        events:[
            {
                title:'Слот 1',
                startDate:'2023-01-26 08:00',
                endDate:'2023-01-26 12:00',
            },
            {
                title:'Слот 2',
                startDate:'2023-01-26 08:00',
                endDate:'2023-01-26 12:00',
            },
            {
                title:'Слот 3',
                startDate:'2023-01-27 08:00',
                endDate:'2023-01-27 12:00',
            },
        ]

    }),
    components: {
        SpringCalendar
    }
};
</script>
