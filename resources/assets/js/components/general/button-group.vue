<template>
        <div>
                <div class='field'>
                    <div class="field has-addons">
                            <p class="control" v-for="button in buttons" >
                                <button class="button" 
                                :href="button.href" 
                                @click="selectButton(button)" 
                                :class="{ 'is-active': button.isActive, 'lg-btn': button.lg }">
                                    
                                    <span v-if='button.lg'>
                                        {{ button.name.split(' ')[0] }}
                                        <br>
                                        {{ button.name.split(' ')[1] }}
                                    </span>
                                    <span v-else v-html='button.name'>
                                            
                                    </span>
                                </button>
                            </p>
                        
                    </div>
                </div>

                <div>
                    <slot></slot>
                </div>
            </div>
</template>

<script>
    export default {
        data() {
            return { buttons: [] };
        },
    
        created() {
            this.buttons = this.$children;
        },
    
        methods: {
            selectButton(selectedTab) {
                this.buttons.forEach(tab => {
                    tab.isActive = (tab.href == selectedTab.href);
                });
                this.$emit('selectValue', selectedTab.href.replace(/[^a-z0-9+]+/gi, ' ').trim(), selectedTab.value);
            }
        },
        computed: {
            multLine(){

            }
        }
    }
</script>
<style>
    .is-active {
        /* background: rgb(187, 187, 187); */
    }
</style>