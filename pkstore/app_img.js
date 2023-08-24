// input要素
const fileInput = document.getElementById('item_img_path');
// changeイベントで呼び出す関数
const handleFileSelect = () => {
  const files = fileInput.files;
  for (let i = 0; i < files.length; i++) {
    console.log(files[i]) // 1つ1つのファイルデータはfiles[i]で取得できる
  }
}
// ファイル選択時にhandleFileSelectを発火
fileInput.addEventListener('change', handleFileSelect);