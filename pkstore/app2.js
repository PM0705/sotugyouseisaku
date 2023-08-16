console.log("ここを表示する");


const submit = document.querySelector(".submit");

submit.addEventListener("click", e => {
   // 「送信」ボタンの要素にクリックイベントを設定する
   submit.addEventListener('click', (e) => {
    // デフォルトアクションをキャンセル
     e.preventDefault();

     // 「名前（姓）」入力欄の空欄チェック
        // フォームの要素を取得
        const namename = document.querySelector('#namename');
        // エラーメッセージを表示させる要素を取得
        const errMsgnamename = document.querySelector('.err-msg-namename');
        if(!namename.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgnamename.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgnamename.textContent = '名前（姓）が未入力です。';
            // クラスを追加(フォームの枠線を赤くする)
            namename.classList.add('input-invalid');
            // 後続の処理を止める
            //エラーが起きたところでerror_flag = true;を入力
            error_flag = true;
            // e.preventDefault();
            // return;
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgnamename.textContent ='';
            // クラスを削除
            namename.classList.remove('input-invalid');
        }
    
});
});
