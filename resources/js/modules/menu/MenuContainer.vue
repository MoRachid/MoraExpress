<template>

<div class="wrapper menu__container">
  <div class="row">
    <div class="col-md-8">
      <card-component>
        <template slot="title">My Menu items</template>
        <template slot="body">
          <div class="section">
            <multiselect
              v-model="menu"
              :options="categories"
            ></multiselect>
          </div>
          <menu-group :items="currentMenuItems"></menu-group>
        </template>
      </card-component>
    </div>
    <div class="col-md-4">
      <card-component>
        <template slot="title">Add menu item</template>
        <template slot="body">
          <menu-add-form 
            :categories="categories" 
            :resto-id="restoId"
            v-on:newItemAdded="addNewItem"
          ></menu-add-form>
        </template>
      </card-component>
    </div>
  </div>
</div>

</template>

<script>
  import _ from 'lodash';
  import Multiselect from 'vue-multiselect';
  import MenuGroup from './MenuGroups';
  import MenuAddForm from './MenuAddForm';

  export default {
    props: ['items', 'restoId'],
    components: {
      Multiselect, MenuGroup, MenuAddForm
    },

    created() {
      _.forEach(this.items, (item, key) => {
          this.categories.push(key);
      });
      this.menu = this.categories[0];
      this.localItems = this.items;
    },

    data() {
      return {
        localItems: '',
        menu: '',
        categories: []
      }
    },

    computed: {
      currentMenuItems() {
        return this.localItems[this.menu];
      }
    },

    methods: {
      addNewItem(item, category) {
        this.localItems[category].unshift(item);
      }
    }

  }
</script>
