<script setup lang="ts">
// import HelloWorld from './components/HelloWorld.vue'
import { ref, onMounted } from "vue"
import { translate_baidu, wiki_baidu, wikipedia } from './utils/myFunction.js'
const pdfUrl = '/2304.pdf';
const selectText = ref('');
const translateText = ref('');

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


        console.log(choose);
        selectText.value = choose;
        // 调用百度翻译API
        translate_baidu(translateText, choose);
      }, true);
    }
  };
};

onMounted(() => {
  getSelectText();
});
</script>

<template>
  <el-row>
    <el-col :span="16">
      <iframe width="900px" height="700px" :src="`web/viewer.html?file=` + encodeURIComponent(pdfUrl)"
        id="pdf_display"></iframe>
    </el-col>
    <el-col :span="8">
      <el-card shadow="hover" class="mgb20" style="height: 340px; width: 350px; float: right;">
        <b>原文（点击进行修改）</b>
        <el-input placeholder="原文" type="textarea" rows="13" v-model="selectText" resize="none"></el-input>
      </el-card>
      <el-card shadow="hover" class="mgb20" style="height: 340px; width: 350px; float: right;">
        <b>译文</b>
        <el-input disabled placeholder="译文" type="textarea" rows="13" v-model="translateText" resize="none"></el-input>
      </el-card>
    </el-col>
  </el-row>
</template>

<style scoped>
.mgb20 {
  margin-bottom: 20px;
}
</style>
