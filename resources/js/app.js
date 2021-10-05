require('./bootstrap');
require('./template/libs/jquery/dist/jquery.min');
require('./template/libs/bootstrap/dist/js/bootstrap.bundle.min');
require('./template/libs/perfect-scrollbar/dist/perfect-scrollbar.min');
require('./template/dist/js/waves');
require('./template/dist/js/sidebarmenu');
require('./template/dist/js/custom');
require('./template/libs/flot/excanvas');
require('./template/libs/flot/jquery.flot');
require('./template/libs/flot/jquery.flot.pie.js');
require('./template/libs/flot/jquery.flot.time.js');
require('./template/libs/flot/jquery.flot.stack.js');
require('./template/libs/flot/jquery.flot.crosshair.js');
require('./template/libs/flot.tooltip/js/jquery.flot.tooltip.min.js');
require('./template/dist/js/pages/chart/chart-page-init.js');
import CKEditor from 'ckeditor4-vue';

Vue.use( CKEditor );
import Vue from 'vue'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('one_-exercise-component', require('./components/exercises/One_ExerciseComponent.vue').default);
Vue.component('two_-exercise-component', require('./components/exercises/Two_ExerciseComponent.vue').default);
Vue.component('three_-exercise-component', require('./components/exercises/Three_ExerciseComponent.vue').default);
Vue.component('four_-exercise-component', require('./components/exercises/Four_ExerciseComponent.vue').default);
Vue.component('five_-exercise-component', require('./components/exercises/Five_ExerciseComponent.vue').default);
Vue.component('six_-exercise-component', require('./components/exercises/Six_ExerciseComponent.vue').default);
Vue.component('seven_-exercise-component', require('./components/exercises/Seven_ExerciseComponent.vue').default);
Vue.component('eight_-exercise-component', require('./components/exercises/Eight_ExerciseComponent.vue').default);
Vue.component('nine_-exercise-component', require('./components/exercises/Nine_ExerciseComponent.vue').default);
Vue.component('ten_-exercise-component', require('./components/exercises/Ten_ExerciseComponent.vue').default);
Vue.component('eleven_-exercise-component', require('./components/exercises/Eleven_ExerciseComponent.vue').default);
Vue.component('twelve_-exercise-component', require('./components/exercises/Twelve_ExerciseComponent.vue').default);
Vue.component('thirteen_-exercise-component', require('./components/exercises/Thirteen_ExerciseComponent.vue').default);
Vue.component('seven_-exercise-component', require('./components/exercises/Seven_ExerciseComponent.vue').default);

const app = new Vue({
    el: '#app',
});
