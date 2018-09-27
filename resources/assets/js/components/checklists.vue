<template>
    <div>
        <div class="checklist-container" v-for="checklist in checklists" :key="checklist.id">
            <h2>{{ checklist.title }}</h2>
            <input
                class="checklist-input"
                type="checkbox"
                v-model="checklist.checked"
                @change="toggle($event.target, checklist.id)"
            >
        </div>
    </div>
</template>

<style>
    .checklist-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .checklist-container:nth-child(even) {
        background-color: #eee;
    }

    .checklist-input {
        height: 30px;
        width: 30px;
    }
</style>

<script>
    export default {
        name: "checklists",
        props: {
            checklistsData: {
                type: Array,
                default() {
                    return [];
                }
            }
        },

        data() {
            return {
                checklists: []
            }
        },

        mounted() {
            this.checklists = this.checklistsData;

            Echo.private('checklist')
                .listen('ChecklistStatusToggle', (rsp) => {
                    let index = this.checklists.findIndex(e => e.id === rsp.checklist.id);
                    if (index > 0) {
                        this.$set(this.checklists, index, rsp.checklist);
                    }

                    console.log(rsp);
                });
        },

        methods: {
            toggle(target, checklistId) {
                let data = {
                    'checked': target.checked,
                    'id': checklistId
                };

                axios.post('/checklists/toggle', data).then((response) => {
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
            },
        }
    }
</script>