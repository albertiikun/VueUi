<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="6">
          <v-card>
            <v-card-title>
              Groups Table
              <v-spacer></v-spacer>
              <v-text-field
                v-model="search"
                label="Search"
                append-icon="search"
                single-line
                hide-details
              >
                <v-icon>search</v-icon>
              </v-text-field>
            </v-card-title>
            <v-data-table
              :headers="headers"
              :items="groups"
              :search="search"
              :page.sync="page"
              :items-per-page="itemsPerPage"
              :footer-props="{ 'items-per-page-options': [5]}"
            >
              <template v-slot:item.edit="{ item }">
                <v-row>
                  <v-chip dark class="mr-2" :color="item.id == itemId ? 'green' : ''">
                    <v-icon small link @click="infoItem(item.id)">mdi-eye</v-icon>
                  </v-chip>
                  <v-chip dark class="mr-2">
                    <v-icon small link @click="deleteItem(item.id, item.name)">mdi-delete</v-icon>
                  </v-chip>
                </v-row>
              </template>
            </v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
export default {
  props: {
    id: String
  },
  mounted() {
    this.getUserGroups();
  },
  data() {
    return {
      search: "",
      dialog: false,
      page: 1,
      groups: [],
      itemsPerPage: 5,
      pagination: {
        itemsLength: 5
      },
      headers: [
        {
          text: "Name",
          align: "left",
          sortable: true,
          value: "name"
        },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "edit", sortable: false }
      ]
    };
  },
  methods: {
    getUserGroups() {
      var app = this;
      this.axios
        .get("", {
          prams: {
            id: app.id
          }
        })
        .then(Response => {
          app.groups = Response.data;
          console.log(Response);
        });
    }
  }
};
</script>