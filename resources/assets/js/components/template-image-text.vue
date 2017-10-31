<template>
    <div class="quote">
        <div :style="quoteStyle" v-html='textPerLine(quote)'></div>

        <div class='author' :style="authorStyle">
            <div class="style-bar" :style='styleBarStle'></div>
            {{ author }}
        </div>
    </div>
</template>

<script>
export default {
    props:['quote', 'quoteStyle', 'author', 'authorStyle', 'styleBarStle'],
    methods: {
        textPerLine(txt){
            var textArr = txt.split(' ')
            for(let i = 0; i < textArr.length; i++){
                    if(i % 5 == 4){
                        textArr.splice(i, 0, '<br />');
                    }
                    
                
            }

            return textArr.join(' ');
        }
    }

}
</script>
        