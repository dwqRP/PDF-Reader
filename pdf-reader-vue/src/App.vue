<script setup lang="ts">
// import HelloWorld from './components/HelloWorld.vue'
import { ref, onMounted, reactive, inject } from "vue"


import { translate_baidu } from "./utils/myFunction.js"
import "./global.css"

const pdfUrl = inject('message') as string;
const selectText = ref('');
const translateText = ref('');
const lineCount = reactive({
  num: 31
});


const getLineNum = () => {
  var contentDiv = document.getElementById("content") as Element;
  var contentHeight = contentDiv.clientHeight;
  var lineHeight = parseFloat(getComputedStyle(contentDiv).lineHeight);
  lineCount.num = Math.floor(contentHeight / lineHeight);
  lineCount.num = Math.floor((lineCount.num - 3) / 2);
  console.log("Number of lines:", lineCount.num);
}

// 滑选事件注册： 获取鼠标选中的文本
const getSelectText = () => {
  let x1 = 0, y1 = 0, x2 = 0, y2 = 0;
  let iframe = document.getElementById('pdf_display') as HTMLIFrameElement;
  // iframe 加载完成后执行并将单击事件过滤掉，因为单击事件可能也触发滑选，所以为了不误操作，将其剔除
  iframe.onload = function () {
    // 鼠标点击监听
    if (iframe.contentDocument) {
      iframe.contentDocument.addEventListener('mousedown', function (e) {
        x1 = e.pageX;
        y1 = e.pageY;
      }, true);
      // 鼠标抬起监听
      iframe.contentDocument.addEventListener('mouseup', function (e) {
        x2 = e.pageX;
        y2 = e.pageY;
        if (x1 == x2 && y1 == y2) return; //判断点击和抬起的位置，如果相同，则视为没有滑选，不支持双击选中
        let choose = iframe.contentWindow!.getSelection()!.toString();
        //处理换行符
        const chooseChars = [...choose]; // 转换为字符处理，TS String类只读
        for (let i = 0; i < chooseChars.length; i++) {
          if (chooseChars[i] == '\n' && chooseChars[i + 1] >= 'a' && chooseChars[i + 1] <= 'z') {
            chooseChars[i] = ' ';
          }
        }
        choose = chooseChars.join(''); // 恢复字符串
        console.log(choose);
        selectText.value = choose;
        // 调用百度翻译API
        translate_baidu(translateText, choose);
      }, true);
    }
  };
};

const retran = function () {
  // alert(selectText.value);
  translate_baidu(translateText, selectText.value);
}

const test = function () {
  // alert(selectText.value);
  alert(cardChoose);
}

onMounted(() => {
  getLineNum();
  getSelectText();
});
</script>

<script lang="ts">
import Modal from './Modal.vue'

var titles = ['title1', 'title2', 'title3'];
var contents = ['content1', 'content2', 'content3'];

export default {
  components: {
    Modal
  },
  data() {
    return {
      showModal: false,
      titles: titles,
      contents: contents,
    }
  },
  methods: {
	  showCards() {
      this.showModal = true;
      //...
  	}
	}
}

</script>

<template>
  <!-- <div class="model" v-show="isShowMultiple" @click="setMaskShow($event)">
      <div class="modelFixed" ref="child">
                       此处为内容区
      </div>
  </div> -->
  <Teleport to="body">
    <!-- 使用这个 modal 组件，传入 prop -->
    <modal :show="showModal" @close="showModal = false" :titles="titles" :contents="contents">
      <template #header>
        <h3>custom header</h3>
      </template>
    </modal>
  </Teleport>
  <div style="width: 100vw;height: 100vh;" id="content">
    <el-row>
      <el-col :span="16">
        <iframe :src="`web/viewer.html?file=` + encodeURIComponent(pdfUrl)" id="pdf_display" class="ifr"></iframe>
      </el-col>
      <el-col :span="8">
        <el-card shadow="hover" style="height: 49vh; width: 33vw;margin-bottom: 2vh;background-color: #f9f9fa;">
          <el-button color="#626aef" style="margin-bottom: 3px;" size="small" plain id="show-modal" @click="showCards">选择闪卡</el-button>
          <b> 原文（点击进行修改）</b>
          <el-button color="#626aef" style="margin-bottom: 3px;" size="small" plain @click="retran">重新翻译</el-button>
          <el-button color="#626aef" style="margin-bottom: 3px;" size="small" plain @click="test">测试</el-button>
          <el-input placeholder="原文" type="textarea" :rows="lineCount.num" v-model="selectText" resize="none"></el-input>
        </el-card>
        <el-card shadow="hover" style="height: 49vh; width: 33vw;background-color: #f9f9fa;">
          <b>译文</b>
          <el-input disabled placeholder="译文" type="textarea" :rows="lineCount.num" style="height: 45vh;"
            v-model="translateText" resize="none"></el-input>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<style scoped>
/*引入全局样式*/
.ifr {
  width: 66vw;
  height: 100vh;
  float: left;
}

.mgb20 {
  margin-bottom: 20px;
}
</style>
