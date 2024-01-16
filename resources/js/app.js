import './bootstrap';
import 'flowbite';
import { createApp } from 'vue';

import RoleTogglePermission from "./components/RoleTogglePermission.vue";
import togglePermission from "./components/togglePermission.vue";
import RolesPermissionsManager from "./components/RolesPermissionsManager.vue";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const app = createApp({});
app.component('RolesPermissionsManager', RolesPermissionsManager);
app.component('RoleTogglePermission', RoleTogglePermission);
app.component('togglePermission', togglePermission);
app.mount('#app');