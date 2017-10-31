<template>
    <div ids="order-select">
        <div class='field size-buttons' >

            <div class='field'>
            <label class="label">Theme</label>
                <button-group @selectValue="setTheme">
                    <btn name="Spiritual" :selected="true"></btn>
                    <btn name="Science" :selected="false"></btn>
                    <btn name="Success" :selected="false"></btn>
                </button-group>
            </div>

            <div class='field'>
                <label class="label">Format</label>
                <button-group @selectValue="setFormat">
                    <btn name="JPEG Animation" :selected="true"></btn>
                    <btn name="Gif Animation" :selected="false"></btn>
                    <btn name="MP4 Animation" :selected="false"></btn>
                </button-group>
            </div>



            <label class="label">Size</label>
            <button-group @selectValue="setResolution">
                <btn name="Instagram 1080x1080" :selected="true" :lg='true'></btn>
                <btn name="Facebook 1080x1080" :selected="false" :lg='true'></btn>
                <btn name="Pintrest 735x735" :selected="false" :lg='true'></btn>
                <btn name="Twitter 1024x512" :selected="false" :lg='true'></btn>
            </button-group>


        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            theme: '',
            format: '',
            resolution: ''
        }
    },
    methods: {
        setResolution(val){
            this.resolution = val.split(' ')[1];
        },
        setFormat(val){
            this.format = val.split(' ')[0];
        },
        setTheme(val){
            this.theme = val;
        }
    }
}
</script>
