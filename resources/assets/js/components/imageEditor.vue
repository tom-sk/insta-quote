<template>
<div id="image-app" class="container">
              
  <div class='columns '>
    <div class='column'>
      <section class="section">
          <div class="container image-editor-header">
            
            <h1 v-if='!template && !free' class="title">New Template</h1>
            <h1 v-if='template' class="title">Edit Template</h1>

            <h1 v-if='free' class="title">Free Download</h1>
            
            <p class="subtitle">

              <span v-if='template'>Edit custom template</span>
              <span v-if='!template  && !free'>Create a new custom template</span>

              <div v-if='!free' class='save-buttons'>
                <a href='/user-templates'>
                  <button class='button'  @click="onSubmit">Save</button>
                </a>
              </div>
              <div v-if='free' class='save-buttons'>
                <a href='/download-link-free'>
                  <button class='button'  @click="onSubmit">Download</button>
                </a>
              </div>

            </p>
          </div>
        </section>
    </div>
  </div>

  <div class='columns image-editor'>
    <div class='column is-6 left background-image' :style="borderObject">
        <div class='overlay' :style="overlayObject">
          <template-image-text
            :quote='form.quote' 
            :quoteStyle='quoteTextObject'
            :author='form.author'
            :authorStyle='authorTextObject'
            :styleBarStle='barObject'>
          </template-image-text>

        </div>

        <img :style="watermarkObject" class='watermark' :src="form.userImage" />
    </div>
  
    
    <div class='column'>
        <div class='field'>
            <label class="label">Background Image</label>
        </div>

        <!-- IMAGE GRID -->
        <div class='field '>
          <image-grid @selectBg='backgroundSelect' :images='form.images'></image-grid>
        </div>

        <!-- QUOTE TEXT -->
        <div class="columns">
          <div class="column">
            <div class="field">
              <label class="label">Quote</label>
              <div class="control">
                <textarea class='textarea' v-model='form.quote'></textarea>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="field">
              <label class="label">Author</label>
              <div class="control">
                <textarea class='textarea' v-model='form.author' type="text"></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- COLOUR CHANGE -->
        <div class='field'>
          <div class='field'>
            <label class="label">Text Color</label> <div class=''></div>
          </div>
          
          <div class='field'>
            <vue-slider 
              ref="slider" 
              v-model="form.rValue" 
              tooltip='false' :min='0' :max='255' 
              :processStyle='form.rSliderColor'>
            </vue-slider>

            <vue-slider 
              ref="slider" 
              v-model="form.gValue" 
              tooltip='false' :min='0' :max='255' 
              :processStyle='form.gSliderColor'>
            </vue-slider>

            <vue-slider 
              ref="slider" 
              v-model="form.bValue" 
              tooltip='false' :min='0' :max='255' 
              :processStyle='form.bSliderColor'>
            </vue-slider>
          </div>

          <div class='columns'>
              <div class="column field is-marginless">
                  <div class="control">
                    <input class="input" v-model="form.rValue" type='number'>
                  </div>
                </div>

                <div class="column field is-marginless">
                  <div class="control">
                    <input class="input" v-model="form.gValue" type='number'>
                  </div>
                </div>

                <div class="column field is-marginless">
                  <div class="control">
                    <input class="input" v-model="form.bValue" type='number'>
                  </div>
                </div>
          </div>

          </div>
        <!-- QUOTE TEXT CHANGE -->
        <div class='field'>
          <div class="columns">
            <div class="column">
              <div class='field'>
                <label class="label">Quote</label>
                <button-group @selectValue="quoteTextPositionChange">
                  <btn name="<i class='fa fa-align-left' value='left'></i>" :selected="false" value='left'></btn>
                  <btn name="<i class='fa fa-align-center' value='center'></i>" :selected="true" value='center'></btn>
                  <btn name="<i class='fa fa-align-right' value='right'></i>" :selected="false" value='right'></btn>
                </button-group>

                <font-select @selectFont="setQuoteFont" :fonts="form.fonts"></font-select>
              </div>
            </div>
            <div class="column">
      
              <label class="label">Author</label>
      
              <button-group @selectValue="authorTextPositionChange">
                <btn name="<i class='fa fa-align-left' value='left'></i>" :selected="false" value='left'></btn>
                <btn name="<i class='fa fa-align-center' value='center'></i>" :selected="true" value='center'></btn>
                <btn name="<i class='fa fa-align-right' value='right'></i>" :selected="false" value='right'></btn>
              </button-group>
        
              <font-select @selectFont="setAuthorFont" :fonts="form.fonts"></font-select>

            </div>
            <div class="column">
              <!-- STYLE BAR -->
              <label class="label">Style Bar</label>
              
                <button-group @selectValue="barPositionChange">
                  <btn name="<i class='fa fa-align-left' value='left'></i>" :selected="false" value='left'></btn>
                  <btn name="<i class='fa fa-align-center' value='center'></i>" :selected="true" value='center'></btn>
                  <btn name="<i class='fa fa-align-right' value='right'></i>" :selected="false" value='right'></btn>
                </button-group>

                <button-group @selectValue="barShow">
                  <btn name="Solid" :selected="true" value='display'></btn>
                  <btn name="None" :selected="false" value='none'></btn>
                </button-group>
            </div>
            <div class='column'>
              <!-- IMAGE BORDER -->
              <div class='field'>
                <label class="label">Image Border</label>
              
                <div class="field has-addons">
              
                  <button-group @selectValue="imageBorderChange">
                    <btn name="On" :selected="true" value='display'></btn>
                    <btn name="Off" :selected="false" value='none'></btn>
                  </button-group>
              
                </div>
              </div>
            </div>
          </div>
        </div>
       

        <!-- OVERLAY CHANGE -->
        <div class='field'>
          <label class="label">Overlay</label>

          <button-group @selectValue="overlayChange">
            <btn name="Overlay" :selected="true" value='overlay'></btn>
            <btn name="Border" :selected="false" value='border'></btn>
            <btn name="Bars" :selected="false" value='bars'></btn>
            <btn name="None" :selected="false" value='none'></btn>
          </button-group>

        </div>

        <div class='field'>

          <label class="label">Water Mark/Copyright</label>

          <div v-if="!form.userImage">
            <input type="file" @change="onFileChange">
          </div>
          <div v-else>
            <div class="field">
              <button class="button" @click="removeImage">Remove image</button>
            </div>


            <button-group @selectValue="watermarkPositionChange">
              <btn name="Top" :selected="false" value='top'></btn>
              <btn name="Bottom" :selected="true" value='bottom'></btn>
            </button-group>

            <button-group @selectValue="watermarkPositionChange">
              <btn name="<i class='fa fa-align-left' value='left'></i>" :selected="false" value='left'></btn>
              <btn name="<i class='fa fa-align-center' value='center'></i>" :selected="true" value='center'></btn>
              <btn name="<i class='fa fa-align-right' value='right'></i>" :selected="false" value='right'></btn>
            </button-group>

            
          </div>
        </div>

      </div>
    
  </div>
</div> <!-- end of app -->
    
    

  </template>
  
<script>

import vueSlider from 'vue-slider-component';
import Form from '../helper/Form.js'
import axios from 'axios';
export default {
  components: {
      vueSlider
  },
  props: ['template', 'free'],
  data () {
    return {
      form: new Form({
        quote: 'The Way Get Started Is To Quit Talking And Begin Doing.',
        author:'Walt Disney',
        image: 'backgrounds/background1.jpg',
        imageURL: 'backgrounds/background1.jpg',
        userImage: '',
        typedQuote: '',
        isMoving: false,
        rValue:255,
        gValue:255,
        bValue:255,
        quoteTextStyle: {
          position: 'center',
          fontSize: '25',
          fontType: 'Arial'
        },
        authorTextStyle: {
          position: 'center',
          fontSize: '25',
          fontType: 'Arial'
        },
        overlayStyle: {
          backgroundOpacity: 0.3,
          borderTop : '',
          borderBottom: '',
          borderLeft : '',
          borderRight: ''
        },
        barStyle: {
          marginLeft: '',
          marginRight: '',
          color: '',
          borderWidth: ''
        },
        borderStyle: {
          border: '2px'
        },
        watermarkStyle: {
          top: '',
          bottom: '',
          left: '',
          right: ''
        },
        rSliderColor: {"backgroundColor": `#F44336`},
        gSliderColor: {"backgroundColor": `#00C853`},
        bSliderColor: {"backgroundColor": `#03A9F4`},
        fonts: [
          {
            name: 'Arial',
            fontSize: '16px'
          }, 
          {
            name: 'Courier',
            fontSize: '18px'
          }, 
          {
            name: 'Verdana',
            fontSize: '15px'
          }, 
          {
            name: 'Georgia',
            fontSize: '17px'
          }
        ],
        images: [
          {
            src: 'https://images.unsplash.com/photo-1500964757637-c85e8a162699?dpr=1&auto=compress,format&fit=crop&w=1078&h=&q=80&cs=tinysrgb&crop='
          },
          {
            src: 'https://images.unsplash.com/photo-1428447207228-b396f310848b?dpr=1&auto=compress,format&fit=crop&w=1050&h=&q=80&cs=tinysrgb&crop='
          },
          {
            src: 'https://images.unsplash.com/photo-1472806679307-eab7abd1eb32?dpr=1&auto=compress,format&fit=crop&w=1050&h=&q=80&cs=tinysrgb&crop='
          },
          {
            src: 'https://images.unsplash.com/photo-1468818461933-b1d79f62434e?dpr=1&auto=compress,format&fit=crop&w=1051&h=&q=80&cs=tinysrgb&crop='
          }
        ]
      })
    }
  },
  created(){

    if(this.template){
      this.form.quote = this.template.quote
    }
    
  },
  computed: {
    borderObject(){
      return {
        'border-color': `rgb(${this.form.rValue}, ${this.form.gValue}, ${this.form.bValue})`,
        'color' : `rgb(${this.form.rValue}, ${this.form.gValue}, ${this.form.bValue})`,
        'border-width': this.form.borderStyle.border,
        'background': 'url(' + this.form.image +  ')',
        'background-size': 'cover',
        'background-position': 'center center',
        'background-repeat': 'no-repeat',
       ' text-align':'center',
        'margin': 'auto',
        'padding': '0',
      }
    },
    processStyle2(){
      return {
        "backgroundColor": `rgb(${this.form.rValue}, ${this.form.gValue}, ${this.form.bValue})`
      }
    },
    quoteTextObject(){
      return {
        'font-size':this.form.quoteTextStyle.fontSize + 'px',
        'font-family': this.form.quoteTextStyle.fontType,
        'align-items': 'center',
        'text-align':this.form.quoteTextStyle.position
      }
    },
    authorTextObject(){
      return {
        'font-size':this.form.authorTextStyle.fontSize + 'px',
        'font-family': this.form.authorTextStyle.fontType,
        'align-items': 'center',
        'text-align':this.form.authorTextStyle.position
      }
    },
    overlayObject(){
      return {
        'background': `rgba(51, 51, 51, ${this.form.overlayStyle.backgroundOpacity})`,
        'border-top': this.form.overlayStyle.borderTop,
        'border-bottom': this.form.overlayStyle.borderBottom,
        'border-left': this.form.overlayStyle.borderLeft,
        'border-right': this.form.overlayStyle.borderRight,
        'border-color': `rgb(${this.form.rValue}, ${this.form.gValue}, ${this.form.bValue})`
      //  'border': this.form.overlayStyle.border
      }
    },
    barObject(position){
      return {
        'margin-right': this.form.barStyle.marginRight,
        'margin-left': this.form.barStyle.marginLeft,
        'border-color': `rgb(${this.form.rValue}, ${this.form.gValue}, ${this.form.bValue})`,
        'border-width' : this.form.barStyle.borderWidth
      }
    },
    watermarkObject(){
      return {
        'top': this.form.watermarkStyle.top,
        'bottom': this.form.watermarkStyle.bottom,
        'left': this.form.watermarkStyle.left,
        'right': this.form.watermarkStyle.right
      }
    }
  },
  methods: {
    onSubmit(){
      if(this.free){
        this.form.post('/free-template-save').then(() => {
          return axios.get('/download-link-free');
        });
      } else {
        this.form.post('/new-template');
      }
    },
    quoteTextPositionChange(href, val){
      // console.log(b);
      this.form.quoteTextStyle.position = val;
    },
    authorTextPositionChange(href, val){
      this.form.authorTextStyle.position = val;
    },
    setAuthorFont(val){
      this.form.authorTextStyle.fontType = val;
    },
    setQuoteFont(val){
      this.form.quoteTextStyle.fontType = val;
    },
    overlayChange(e, val){
      var borderColor = `rgb(${this.form.rValue}, ${this.form.gValue}, ${this.form.bValue})`;
      var borderVal = `2px solid ${borderColor}`;
      // var noBorder = `0px solid ${borderColor}`;
      var noBorder = null;

      if(val == 'none') {

        this.form.overlayStyle.backgroundOpacity = 0;
        this.form.overlayStyle.borderTop = noBorder;
        this.form.overlayStyle.borderLeft = noBorder;
        this.form.overlayStyle.borderRight = noBorder;
        this.form.overlayStyle.borderBottom = noBorder;
        
      } else if(val == 'border'){

        this.form.overlayStyle.backgroundOpacity = 0;
        this.form.overlayStyle.borderTop = borderVal;
        this.form.overlayStyle.borderLeft = borderVal;
        this.form.overlayStyle.borderRight = borderVal;
        this.form.overlayStyle.borderBottom = borderVal;

      } else if(val == 'bars'){

        this.form.overlayStyle.backgroundOpacity = 0;
        this.form.overlayStyle.borderTop = borderVal;
        this.form.overlayStyle.borderBottom = borderVal;
        this.form.overlayStyle.borderLeft = noBorder;
        this.form.overlayStyle.borderRight = noBorder;

      } else if(val == 'overlay'){

        this.form.overlayStyle.backgroundOpacity = 0.3;
        this.form.overlayStyle.borderTop = noBorder;
        this.form.overlayStyle.borderLeft = noBorder;
        this.form.overlayStyle.borderRight = noBorder;
        this.form.overlayStyle.borderBottom = noBorder;
      }
    },
    barPositionChange(e, val){
      if(val == 'right'){
        // this.form.barStyle.margin = 'auto';
        this.form.barStyle.marginRight = '0px';
        this.form.barStyle.marginLeft = 'auto';
      } else if(val == 'left'){
        this.form.barStyle.marginLeft = '0px';
        this.form.barStyle.marginRight = 'auto';

      } else if(val == 'center') {
        
        this.form.barStyle.marginRight = null;
        this.form.barStyle.marginLeft = null;

      }
    },
    watermarkPositionChange(e, val){
      if(val == 'right'){
        // this.form.barStyle.margin = 'auto';
        this.form.watermarkStyle.right = '0px';
        this.form.watermarkStyle.left = 'auto';
      } else if(val == 'left'){
        this.form.watermarkStyle.left = '0px';
        this.form.watermarkStyle.right = 'auto';

      } else if(val == 'center') {
        
        this.form.watermarkStyle.right = 'auto';
        this.form.watermarkStyle.left = 'auto';

      } else if (val == 'top') {
        this.form.watermarkStyle.top = '0px';
        this.form.watermarkStyle.bottom = 'auto';
      } else if (val == 'bottom') {
        this.form.watermarkStyle.bottom = '0px';
        this.form.watermarkStyle.top = 'auto';
      
      }
    },
    barShow(e, val){
      if(val == 'none'){
        this.form.barStyle.borderWidth = '0px'
      } else if(val == 'display'){
        this.form.barStyle.borderWidth = '2px'
      }
    },
    imageBorderChange(href, value){
      if(value == 'none'){
        this.form.borderStyle.border = '0px'
      } else if(value == 'display'){
        this.form.borderStyle.border = '2px'
      }
    },
    moveDiv(e){
      this.form.isMoving = !this.form.isMoving;
    },
    animateText(str){
      // return str.split('').reverse().join('');
      return str;
    },
    backgroundSelect(val, rawURL){
      console.log(rawURL);
      this.form.image = val;
      this.form.imageURL = rawURL;
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.form.userImage = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function (e) {
      this.form.userImage = '';
    }
  }
}
</script>

