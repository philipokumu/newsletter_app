<template>
  <button
    class="h-10 w-10 grid place-items-center rounded-full text-primary-500 hover:bg-gray-100 focus:bg-gray-100 ring-primary-500 focus:ring-2 transition focus:outline-none"
    @click.stop="toggleSidebar"
  >
    <div class="h-2/3 w-2/3">
      <menu-icon />
    </div>
  </button>
</template>

<script>
import { mapActions } from 'vuex';
import MenuIcon from '../Icons/MenuIcon.vue';

export default {
  name: 'SidebarToggle',
  components: { MenuIcon },
  methods: {
    ...mapActions({
      toggleSidebar: 'toggleSidebar'
    })
  }
};
</script>
