import { initializeApp } from "firebase/app";
import { getAuth, GoogleAuthProvider, signInWithPopup, signOut } from "firebase/auth";//createUserWithEmailAndPassword, signInWithEmailAndPassword, 
import { getFirestore } from "firebase/firestore"; 

const app = initializeApp({
    apiKey: "AIzaSyBpdAmST1s6FD9yAmCrUoPLQ-mg8BGXCac",
    authDomain: "addulting-fc16e.firebaseapp.com",
    projectId: "addulting-fc16e",
    storageBucket: "addulting-fc16e.appspot.com",
    messagingSenderId: "941943380813",
    appId: "1:941943380813:web:dcf31919ed4cdc5c493504",
    measurementId: "G-89VD8JX662"
  });

//const app = firebase.initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

const googleProvider = new GoogleAuthProvider();

const signInWithGoogle = async () => {
    signInWithPopup(auth, googleProvider)
        .then((result) => {
            const credential = GoogleAuthProvider.credentialFromResult(result);
            const token = credential.accessToken;
            const user=result;
        }).catch((error) => {
            const errorCode = error.code;
            const errorMessage = error.message;
            const email = error.email;
            const credential = GoogleAuthProvider.credentialFromError(error);
        })
};

// const emailSignIn = async (email, password) => {
//     signInWithEmailAndPassword(auth, email, password)
//         .then((userCredential) => {
//             const user = userCredential.user;
//         }).catch((error) => {
//             const errorCode = error.code;
//             const errorMessage = error.message;
//         })
// };

// const registerWithEmailAndPassword = async (name, email, password) => {
//     createUserWithEmailAndPassword(auth, email, password)
//         .then((userCredential) => {
//             const user = userCredential.user;
//         }).catch((error) => {
//             const errorCode = error.code;
//             const errorMessage = error.message;
//         });
// };

// const sendPasswordResetEmail = async (email) => {
//     try {
//         await auth.sendPasswordResetEmail(email);
//         alert("Password reset link sent!");
//     } catch (err) {
//         console.error(err);
//         alert(err.message);
//     }
// };

const logout = () => {
    signOut(auth).then(() => {
        // sign out successful
    }).catch((err) => {
        //somehow there was an error :o
        console.error(err);
        alert(err.message);
    });
};

// maybe implement email sign in one day
export {
    auth,
    db,
    signInWithGoogle,
    //emailSignIn,
    //registerWithEmailAndPassword,
    //sendPasswordResetEmail,
    logout,
};