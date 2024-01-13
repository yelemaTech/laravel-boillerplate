import './bootstrap';
import 'flowbite';
import { createApp } from 'vue';

import Test from "./components/Test.vue";
import RolesPermissionsManager from "./components/RolesPermissionsManager.vue";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const app = createApp({});
app.component('RolesPermissionsManager', RolesPermissionsManager);
app.mount('#app');
