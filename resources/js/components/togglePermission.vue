<template>
    <fwb-toggle v-model="toggle" :label="texte" :disabled="!canToggle"/>
  </template>
  
  <script setup>
import { ref, onMounted, onBeforeMount } from 'vue';
import { FwbToggle } from 'flowbite-vue'

const props = defineProps({
                    role:Number,
                    permissionId:Number,
                    hasPermission:Number,
                    userCanToggle:Number,
                });
  
  const toggle = ref(false)
  const canToggle = ref(true)
const texte = ref('');

function switchText() {
  texte.value = (toggle.value == true) ? 'activé' : 'désactivé';
}

  
onBeforeMount(() => {
    console.log("-------------------------")
    console.log('role: ',props.role)
    console.log('permissionId: ',props.permissionId)
    console.log('hasPermission: ',props.hasPermission)
    console.log('userCanToggle: ',props.userCanToggle)
    console.log('toggle: ',toggle.value)
    console.log('canToggle: ',canToggle.value)
    toggle.value = (props.hasPermission == 1) ?true:false;
    canToggle.value = (props.userCanToggle == 1) ?true:false;
    console.log("***")
    console.log('toggle: ',toggle.value)
    console.log('canToggle: ',canToggle.value)
    switchText();
});
  </script>