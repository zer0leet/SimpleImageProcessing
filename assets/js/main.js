
var firebaseConfig = {
    apiKey: "AIzaSyBPwZZcrZZoP-zDH9jc6sbJZV2I2nE1qO8",
    authDomain: "codepen-upload.firebaseapp.com",
    databaseURL: "https://codepen-upload.firebaseio.com",
    projectId: "codepen-upload",
    storageBucket: "codepen-upload.appspot.com",
    messagingSenderId: "646930112749",
    appId: "1:646930112749:web:2f6bf3b41ac5075b5b6ce4",
    measurementId: "G-9R61D4LB2S"
  };
 // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
 firebase.analytics();

// upload box where you can drag files
let dropArea = document.getElementById("uploadBox");
      let fileURL;
      let fileArray = [];
// we put an eventlistner on the upload box
      ["dragenter", "dragover", "dragleave", "drop"].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
      });

      function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
      }

// on draging element over the box we fire the highlight function
      ["dragenter", "dragover"].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
      });
// on draging element out of the box or droping it we fire the unhighlight function
      ["dragleave", "drop"].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
      });

      function highlight(e) {
        dropArea.classList.add("highlight");
      }

      function unhighlight(e) {
        dropArea.classList.remove("highlight");
      }
// on drop fire function handle drop
      dropArea.addEventListener("drop", handleDrop, false);

// handle drop function which uploads the files using firebase when you drop the selected files
      function handleDrop(e) {
        let dt = e.dataTransfer;
        let files = dt.files;
        handleFiles(files);
      }
      function handleFiles(files) {
        [...files].forEach(uploadFile);
      }
      function uploadFile(file) {
        // create ref
        const storageRef = firebase.storage().ref("uploaded_files/" + Date.now() + '-' + file.name); //Date.now() + '-' +
        // upload file
        const task = storageRef.put(file);
        // upload indicator
        task.on(
          "state_changed",
          function progress(snapshot) {
            const percentage =
              (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
            console.log(percentage);
            $("#drag-title,#drag-subTitle").addClass("d-none");
            $(".uploading").removeClass("d-none");
            $(".done").addClass("d-none");
          },
          function error() {},
          function complete() {
            $("#sendbtn").removeAttr("disabled");
            task.snapshot.ref.getDownloadURL().then(function(downloadURL) {
              fileURL = downloadURL;
              $(".done").removeClass("d-none");
              $(".uploading").addClass("d-none");
              fileArray.push(fileURL);
              $("#submitButton").removeAttr("disabled");
            });
          }
        );
      }
  // here we store files in database
      function storeFiles() {
        const db = firebase.firestore();
        db.collection("uploadedfiles")
          .add({
            files: fileArray
          })
          .then(function(docRef) {
            console.log("Document written with ID: ", docRef.id);
            $(".success").removeClass("d-none");
            $("#submitButton").attr("disabled", "disabled");
          })
          .catch(function(error) {
            console.error("Error adding document: ", error);
            $("#submitButton").removeAttr("disabled");
          });
      }

// on input change we upload the given files -- Used only when you click the box and use the normal method to upload
      $("input").change(function(e) {
        // Get the file
        const file = e.target.files[0];
        // create ref
        const storageRef = firebase.storage().ref("uploaded_files /" + Date.now() + '-' + file.name);
        // upload file
        const task = storageRef.put(file);
        // upload indicator
        task.on(
          "state_changed",
          function progress(snapshot) {
            const percentage =
              (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
            console.log(percentage);
            $("#drag-title,#drag-subTitle").addClass("d-none");
            $(".uploading").removeClass("d-none");
            $(".done").addClass("d-none");
          },
          function error() {},
          function complete() {
            $("#sendbtn").removeAttr("disabled");
            task.snapshot.ref.getDownloadURL().then(function(downloadURL) {
              $(".done").removeClass("d-none");
              $(".uploading").addClass("d-none");
              console.log(downloadURL);
              fileArray.push(downloadURL);
              $("#submitButton").removeAttr("disabled");
            });
          }
        );
      });

// when click submit button we store the files urls in the database
      $("#submitButton").click(function() {
        storeFiles();
      });