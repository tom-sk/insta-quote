<template>
    <div class=''>
                                    


        <button @click='toggleModal' class='button'>Change Background Image</button>

            <transition name="fade">
                    <div v-if="isActive" class="modal" :class="{ 'is-active': isActive }">
                        <div class="modal-background"></div>
                        <div class="modal-content">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Select Background Image</p>
                                <button @click='toggleModal' class="delete" aria-label="close"></button>
                            </header>
                            <section class="modal-card-body">
                            <div class='field image-grid'>
                                <figure @click='backgroundSelect' v-for='(image, i) in images' class="image is-128x128">
                                    <img :index='i + 1' :src="getPic(i)">
                                </figure>
                            </div>
                            </section>
                            <footer class="modal-card-foot">
                                <button @click='toggleModal' class="button is-danger is-outlined">Cancel</button>
                            </footer>
                        </div>
                    </div>
            </transition>






    </div>
</template>
<script>
export default {
    props:['images'],
    data() {
        return {
            bgImages: [],
            isActive: false
        };
    },
    methods: {
       backgroundSelect(e){
        var index = event.target.attributes.index.value;

           this.$emit('selectBg', e.target.src, 'backgrounds/background' + index + '.jpg');
           this.toggleModal();
       },
       toggleModal(){
            this.isActive = !this.isActive;
       },
       getPic(index){
           return 'backgrounds/background' + (index + 1) + '.jpg';
       }
    },
    computed: {

    },
    mounted() {
        this.bgImages = this.images;
    }
}
</script>