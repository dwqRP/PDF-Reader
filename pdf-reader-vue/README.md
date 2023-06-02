<!-- # Vue 3 + TypeScript + Vite

This template should help get you started developing with Vue 3 and TypeScript in Vite. The template uses Vue 3 `<script setup>` SFCs, check out the [script setup docs](https://v3.vuejs.org/api/sfc-script-setup.html#sfc-script-setup) to learn more.

## Recommended IDE Setup

- [VS Code](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin).

## Type Support For `.vue` Imports in TS

TypeScript cannot handle type information for `.vue` imports by default, so we replace the `tsc` CLI with `vue-tsc` for type checking. In editors, we need [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin) to make the TypeScript language service aware of `.vue` types.

If the standalone TypeScript plugin doesn't feel fast enough to you, Volar has also implemented a [Take Over Mode](https://github.com/johnsoncodehk/volar/discussions/471#discussioncomment-1361669) that is more performant. You can enable it by the following steps:

1. Disable the built-in TypeScript Extension
   1. Run `Extensions: Show Built-in Extensions` from VSCode's command palette
   2. Find `TypeScript and JavaScript Language Features`, right click and select `Disable (Workspace)`
2. Reload the VSCode window by running `Developer: Reload Window` from the command palette. -->

### pdf-reader-vue目录介绍
- src\App.vue：划词翻译界面
- src\Modal.vue：闪卡选择界面
- src\utils\myFunction.js：各类API调用函数（百度翻译、有道翻译、维基百科）

### 调试方法
在pdf-reader-vue目录下运行
```
npm install
npm run dev
```

### 打包方法
在pdf-reader-vue目录下运行
```
npx vite build
```
打包成功后在pdf-reader-vue目录下出现dist文件夹

### 与纯html项目合并
删除PDF-Reader\dist\assets文件夹，每次打包生成的js和css文件名称不同造成文件冗余
将打包成功后在pdf-reader-vue目录下出现dist文件夹覆盖PDF-Reader\dist文件夹