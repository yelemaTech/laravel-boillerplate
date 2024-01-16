<template>
    <fwb-toggle v-model="internalHasPermission" :label="texte" v-on:change="getMessageWithAxios" />
    <!-- <fwb-checkbox v-model="internalHasPermission" :label="texte" v-on:change="getMessageWithAxios" /> -->
</template>

<script setup>
import { ref, onMounted, onBeforeMount } from 'vue';
import { FwbToggle, FwbCheckbox  } from 'flowbite-vue';
import axios from 'axios';

const props = defineProps({
                    role:Number,
                    permissionId:Number,
                    hasPermission:Boolean,
                });

// const props = defineProps(['role','permissionId','hasPermission'])

const internalHasPermission = ref(false);
const texte = ref('');

function switchText() {
  texte.value = (internalHasPermission.value == true) ? 'activé' : 'désactivé';
}

function getAction() {
  var action =  internalHasPermission.value == false ? 'remove' : 'add';
console.log('call action: ',action)
  return action;
}

 function getMessageWithAxios () {
  try {
    const { response } = axios.post(
      '/api/roles/add-permission',
      {
        permission_id: props.permissionId,
        role: props.role,
        action: getAction(),
      }
    );
    // this.post = response;
    
    console.log('before internalHasPermission: ',internalHasPermission.value)
    // internalHasPermission.value = !internalHasPermission.value;
    switchText();
  } catch (error) {
    // console.log(error);
  }
    console.log('after internalHasPermission: ',internalHasPermission.value)
}

onBeforeMount(() => {
    internalHasPermission.value = (props.hasPermission == 1) ?true:false;
    switchText();
});

onMounted(() => {
    switchText();
    console.log('*************************************************')
    console.log('role: ',props.role)
    console.log('permissionId: ',props.permissionId)
    console.log('hasPermission: ',props.hasPermission)
    console.log('internalHasPermission: ',internalHasPermission.value)
    console.log('texte: ',texte.value)
    console.log('action: ',getAction())
});
</script>

<style>
</style>
