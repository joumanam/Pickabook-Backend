import React from "react";
import Navbar from "../components/Navbar";
import ImageCard from "../components/ImageCard";
import { useState, useEffect } from "react";
import { toast } from "react-toastify";
import { ToastContainer } from "react-toastify";
import {
    CSSTransition,
    TransitionGroup,
    Transition,
} from "react-transition-group";
const Images = () => {
    const [images, setImg] = useState([]);
    useEffect(() => {
        axios
            .get("http://localhost:8000/api/admin/images/", {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then((res) => {
                const imgs = res.data;
                setImg(imgs);
            })
            .catch((err) => {});
    }, []);

    const approve = async (id) => {
        await axios
            .get("http://localhost:8000/api/admin/images/approve/" + id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then((response) => {
                let code = response.data.code;
                if (parseInt(code) !== 200) {
                    throw new Error("Hmm.. Something wrong happend!");
                }
                const newList = images.filter((item) => item.id != id);
                setImg(newList);
                toast.success("Approved Image");
            })
            .catch((err) => {
                toast.error(err.toString());
            });
    };

    const decline = async (id) => {
        await axios
            .get("http://localhost:8000/api/admin/images/decline/" + id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then((response) => {
                let code = response.data.code;
                if (parseInt(code) !== 200) {
                    throw new Error("Hmm.. Something wrong happend!");
                }
                const newList = images.filter((item) => item.id != id);
                setImg(newList);
                toast.success("Declined Image");
            })
            .catch((err) => {
                toast.error(err.toString());
            });
    };

    return (
        <>
            <Navbar />
            <div className="container">
                <h1 className="custom__text">Images to be approved</h1>
                <hr />
                <div className="d-flex justify-content-center flex-wrap">
                    {images.map((image) => {
                        return (
                            <Transition timeout={300} key={image.id}>
                                <ImageCard
                                    approve={() => approve}
                                    decline={() => decline}
                                    image={image}
                                    key={image.id}
                                />
                            </Transition>
                        );
                    })}
                </div>
            </div>
            <ToastContainer
                position="bottom-center"
                icon={false}
                autoClose={2000}
            />
        </>
    );
};

export default Images;
