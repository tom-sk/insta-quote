<template>
<div id="image-app" class="">
              
  <div class='columns '>
    <div class='column'>
      <section class="section">
          <div class="container image-editor-header">
            
            <h1 v-if='!template' class="title">New Template</h1>
            <h1 v-if='template' class="title">Edit Template</h1>

            <p class="subtitle">

              <span v-if='template'>Edit custom template</span>
              <span v-if='!template'>Create a new custom template</span>

              <div class='save-buttons'>
                <a href='/user-templates'>
                  <button class='button'  @click="onSubmit">Save</button>
                </a>
                
              </div>



            </p>
          </div>
        </section>
    </div>
  </div>

  <div class='columns image-editor'>
    <div class='column is-6 left' :style="borderObject">
    <!-- <div class='column is-6 left' :style="{borderObject, backgroundImage: 'url(' + image + ')', 'background-position': 'center'  }"> -->
        <div class='overlay' :style="overlayObject">

            <div class="quote">
                <div @click='moveDiv' :class="{'is-moved': form.isMoving}" class='' :style="quoteTextObject">
                  {{ form.quote }}
                </div>

                <div class='author' :style="authorTextObject">
                  <div class="style-bar" :style='barObject'></div>
                  {{ form.author }}
                </div>

            </div>

        </div>

        <img :src="form.userImage" />
    </div>
  
    <vue-scrollbar classes="my-scrollbar" ref="Scrollbar" :speed='73'>
    <div class='column is-6 right'>
        <div class='field'>
            <label class="label">Change Background Image</label>
        </div>

        <div class='field image-grid'>
        
          <figure class="image is-128x128">
            <img @click='backgroundSelect' src="https://images.unsplash.com/photo-1500964757637-c85e8a162699?dpr=1&auto=compress,format&fit=crop&w=1078&h=&q=80&cs=tinysrgb&crop=">
          </figure>

          <figure class="image is-128x128">
            <img @click='backgroundSelect' src="https://images.unsplash.com/photo-1428447207228-b396f310848b?dpr=1&auto=compress,format&fit=crop&w=1050&h=&q=80&cs=tinysrgb&crop=">
          </figure>

          <figure class="image is-128x128">
            <img @click='backgroundSelect' src="https://images.unsplash.com/photo-1472806679307-eab7abd1eb32?dpr=1&auto=compress,format&fit=crop&w=1050&h=&q=80&cs=tinysrgb&crop=">
          </figure>

          <figure class="image is-128x128">
            <img @click='backgroundSelect' src="https://images.unsplash.com/photo-1468818461933-b1d79f62434e?dpr=1&auto=compress,format&fit=crop&w=1051&h=&q=80&cs=tinysrgb&crop=">
          </figure>

        </div>

        <!-- QUOTE TEXT -->

        <div class="field">
          <label class="label">Quote</label>
          <div class="control">
            <textarea v-model='form.quote' class='textarea'></textarea>
          </div>
        </div>

        <div class="field">
          <label class="label">Author</label>
          <div class="control">
            <input class="input" v-model='form.author' type="text">
          </div>
        </div>





      <!-- IMAGE BORDER -->
            <div class='field'>
                <label class="label">Image Border</label>

                <div class="field has-addons">
                    <p class="control" @click='imageBorderChange' value='display'>
                        <button class="button" @click='imageBorderChange' value='display'>
                            Border
                        </button>
                    </p>
                    <p class="control">
                        <button class="button" @click='imageBorderChange' value='none'>
                            None
                        </button> 
                    </p>
                </div>
            </div>




        <!-- COLOUR CHANGE -->
        <div class='field'>
          <div class='field'>
            <label class="label">Color</label>
          </div>
          
          <div class='field'>
              Red
            <vue-slider 
              ref="slider" 
              v-model="form.rValue" 
              tooltip='false' :min='0' :max='255' 
              :processStyle='form.rSliderColor'>
            </vue-slider>

              Green
            <vue-slider 
              ref="slider" 
              v-model="form.gValue" 
              tooltip='false' :min='0' :max='255' 
              :processStyle='form.gSliderColor'>
            </vue-slider>

            Blue
            <vue-slider 
              ref="slider" 
              v-model="form.bValue" 
              tooltip='false' :min='0' :max='255' 
              :processStyle='form.bSliderColor'>
            </vue-slider>
          </div>

          <div class='columns'>
              <div class="column is-2 field is-marginless hash">
                <i class="fa fa-hashtag" aria-hidden="true"></i>
              </div>

              <div class="column is-3 field is-marginless">
                  <div class="control">
                    <input class="input" v-model="form.rValue" type='number'>
                  </div>
                </div>

                <div class="column is-3 field is-marginless">
                  <div class="control">
                    <input class="input" v-model="form.gValue" type='number'>
                  </div>
                </div>

                <div class="column is-3 field is-marginless">
                  <div class="control">
                    <input class="input" v-model="form.bValue" type='number'>
                  </div>
                </div>
          </div>

          </div>
        <!-- QUOTE TEXT CHANGE -->
        <div class='field'>
              <label class="label">Quote</label>
              <div class="field has-addons">
                  <p class="control">
                      <button class="button" @click='quoteTextPositionChange' value='left'>
                          <i class="fa fa-align-left" aria-hidden="true" value='left'></i>
                      </button>
                  </p>
                  <p class="control">
                      <button class="button"  @click='quoteTextPositionChange' value='center'>
                          <i class="fa fa-align-center" aria-hidden="true" value='center'></i>
                      </button> 
                  </p>
                  <p class="control">
                      <button class="button"  @click='quoteTextPositionChange' value='right'>
                          <i class="fa fa-align-right" aria-hidden="true" value='right'></i>
                      </button>
                  </p>
              </div>

              <div class='field'>
                  <div class="control">
                      <div class="select">
                          <select  v-model='form.quoteTextStyle.fontType'>
                              <option value="Arial">Arial</option>
                              <option value="Courier">Courier</option>
                              <option value="Verdana">Verdana</option>
                              <option value="Georgia">Georgia</option>
                          </select>
                      </div>
                  </div>
              </div>
        </div>
       

      <div class='field'>
          <label class="label">Author</label>
          <div class="field has-addons">
              <p class="control" value='display'>
                  <button class="button" @click='authorTextPositionChange' value='left'>
                      <i class="fa fa-align-left" aria-hidden="true" value='left'></i>
                  </button>
              </p>
              <p class="control">
                  <button class="button"  @click='authorTextPositionChange' value='center'>
                      <i class="fa fa-align-center" aria-hidden="true" value='center'></i>
                  </button> 
              </p>
              <p class="control">
                  <button class="button"  @click='authorTextPositionChange' value='right'>
                      <i class="fa fa-align-right" aria-hidden="true" value='right'></i>
                  </button>
              </p>
          </div>

          <div class='field'>
              <div class="control">
                  <div class="select">
                      <select  v-model='form.authorTextStyle.fontType'>
                          <option value="Arial">Arial</option>
                          <option value="Courier">Courier</option>
                          <option value="Verdana">Verdana</option>
                          <option value="Georgia">Georgia</option>
                      </select>
                  </div>
              </div>
          </div>
    </div>
       
  
  <!-- STYLE BAR -->

<div class='field'>
  <label  class="label">Style Bar</label>
  <div class="field">
    <label>Position</label>
  </div>
    <div class="field has-addons">
        <p class="control" value='display'>
            <button class="button"   @click='barPositionChange' value='left'>
                <i class="fa fa-align-left" aria-hidden="true" value='left'></i>
            </button>
        </p>
        <p class="control">
            <button class="button"  @click='barPositionChange' value='center'>
                <i class="fa fa-align-center" aria-hidden="true" value='center'></i>
            </button> 
        </p>
        <p class="control">
            <button class="button"  @click='barPositionChange' value='right'>
                <i class="fa fa-align-right" aria-hidden="true" value='right'></i>
            </button>
        </p>
    </div>
    <div class="field">
      <label>Type</label>
    </div>
    <div class="field has-addons">

        <p class="control">
            <button class="button"  @click='barShow' value='display'>
                <i class="fa fa-minus" aria-hidden="true"></i>
             </button> 
        </p>
        <p class="control">
            <button class="button"  @click='barShow' value='none'>
              None
            </button>
        </p>

    </div>

</div>









  <!-- OVERLAY CHANGE -->
<div class='field'>
    <label  class="label">Overlay</label>
    <div class="field has-addons">

        <p class="control">
            <button class="button" @click='overlayChange' value='overlay'>
              Overlay
            </button>
        </p>
        <p class="control">
            <button class="button" @click='overlayChange' value='border'>
              Border
            </button> 
        </p>
        <p class="control">
            <button class="button" @click='overlayChange' value='bars'>
              Bars
            </button>
        </p>
        <p class="control">
            <button class="button" @click='overlayChange' value='none'>
              None
            </button>
        </p>

    </div>
</div>


<div class='field'>
  <div v-if="!form.userImage">
    <input type="file" @change="onFileChange">
  </div>
  <div v-else>
    <button class="button" @click="removeImage">Remove image</button>
  </div>

</div>




  
      </div>
    </vue-scrollbar>
  </div>
</div> <!-- end of app -->
    
    

  </template>
  
<script>

import vueSlider from 'vue-slider-component';
import Form from '../helper/Form.js'

export default {
  components: {
      vueSlider
  },
  props: ['template'],
  data () {
    return {
      form: new Form({
        quote: 'The Way Get Started Is To Quit Talking And Begin Doing.',
        author:'Walt Disney',
        image: 'https://images.unsplash.com/photo-1500964757637-c85e8a162699?dpr=1&auto=compress,format&fit=crop&w=1078&h=&q=80&cs=tinysrgb&crop=',
        userImage: '',
        typedQuote: '',
        isMoving: false,
        rValue:1,
        gValue:1,
        bValue:1,
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
          border: ''
        },
        rSliderColor: {"backgroundColor": `#F44336`},
        gSliderColor: {"backgroundColor": `#00C853`},
        bSliderColor: {"backgroundColor": `#03A9F4`},
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
        'background-position': 'center'
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
    }
  },
  methods: {
    onSubmit(){
      this.form.post('/new-template');
      // axios.get('/new-template');
    },
    quoteTextPositionChange(e){
      this.form.quoteTextStyle.position = e.currentTarget.value;
    },
    authorTextPositionChange(e){
      this.form.authorTextStyle.position = e.currentTarget.value;
    },
    fontChange(e){
      this.form.quoteTextStyle.fontType = e.target.value;
    },
    overlayChange(e){
      var borderColor = `rgb(${this.form.rValue}, ${this.form.gValue}, ${this.form.bValue})`;
      var borderVal = `2px solid ${borderColor}`;
      var noBorder = `0px solid ${borderColor}`;

      if(e.target.value == 'none') {

        this.form.overlayStyle.backgroundOpacity = 0;
        this.form.overlayStyle.borderTop = noBorder;
        this.form.overlayStyle.borderLeft = noBorder;
        this.form.overlayStyle.borderRight = noBorder;
        this.form.overlayStyle.borderBottom = noBorder;
        
      } else if(e.target.value == 'border'){

        this.form.overlayStyle.backgroundOpacity = 0;
        this.form.overlayStyle.borderTop = borderVal;
        this.form.overlayStyle.borderLeft = borderVal;
        this.form.overlayStyle.borderRight = borderVal;
        this.form.overlayStyle.borderBottom = borderVal;

      } else if(e.target.value == 'bars'){

        this.form.overlayStyle.backgroundOpacity = 0;
        this.form.overlayStyle.borderTop = borderVal;
        this.form.overlayStyle.borderBottom = borderVal;
        this.form.overlayStyle.borderLeft = noBorder;
        this.form.overlayStyle.borderRight = noBorder;

      } else if(e.target.value == 'overlay'){

        this.form.overlayStyle.backgroundOpacity = 0.3;
        this.form.overlayStyle.borderTop = noBorder;
        this.form.overlayStyle.borderLeft = noBorder;
        this.form.overlayStyle.borderRight = noBorder;
        this.form.overlayStyle.borderBottom = noBorder;
      }
    },
    barPositionChange(e){
      if(e.currentTarget.value == 'right'){
        // this.form.barStyle.margin = 'auto';
        this.form.barStyle.marginRight = '0px';
        this.form.barStyle.marginLeft = 'auto';
      } else if(e.currentTarget.value == 'left'){
        this.form.barStyle.marginLeft = '0px';
        this.form.barStyle.marginRight = 'auto';

      } else if(e.currentTarget.value == 'center') {
        
        this.form.barStyle.marginRight = 'auto';
        this.form.barStyle.marginLeft = 'auto';

      }
    },
    barShow(e){
      if(e.target.value == 'none'){
        this.form.barStyle.borderWidth = '0px'
      } else if(e.target.value == 'display'){
        this.form.barStyle.borderWidth = '2px'
      }
    },
    imageBorderChange(e){
      if(e.target.value == 'none'){
        this.form.borderStyle.border = '0px'
      } else if(e.target.value == 'display'){
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
    backgroundSelect(e){
      this.form.image = e.currentTarget.src;
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

