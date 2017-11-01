<template>
<div class='field'>
 
    <div class="control">
        <div class="select">
            <select @click="selectFont">
                 
            <option 
                v-for="font in fontList"
                :value="font.name"
                :style="{ 'font-family': font.name, 'font-size': font.fontSize}"> 
                     {{ font.name }} 
            </option>

            </select>
        </div>
    </div>
</div>  
</template>
<script>
export default {
    props:['fonts'],
    data() {
        return {
            fontList: ''
        };
    },
    methods: {
        selectFont(e){
            this.$emit('selectFont', e.target.value);
        }
    },
    computed: {
        
    },
    mounted() {
        console.log(this.fonts)

        this.fontList  = this.fonts;
    }
}
</script>