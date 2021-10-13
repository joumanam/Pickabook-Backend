import React from "react";
import Navbar from "../components/Navbar";
import MessageRow from "../components/MessageRow";
import { useState, useEffect } from "react";
import { toast } from "react-toastify";
import { ToastContainer } from "react-toastify";
import { CSSTransition, TransitionGroup } from "react-transition-group";
const Messages = () => {
    const [messages, setMessages] = useState([]);
    useEffect(() => {
        axios
            .get("http://localhost:8000/api/admin/messages/", {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then((res) => {
                const messages = res.data;
                setMessages(messages);
            })
            .catch((err) => {});
    }, []);

    const approve = async (id) => {
        await axios
            .get("http://localhost:8000/api/admin/messages/approve/" + id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then((response) => {
                let code = response.data.code;
                if (parseInt(code) !== 200) {
                    throw new Error("Hmm.. Something wrong happend!");
                }
                const newList = messages.filter((item) => item.id != id);
                setMessages(newList);
                toast.success("Approved Message");
            })
            .catch((err) => {
                toast.error(err.toString());
            });
    };

    const decline = async (id) => {
        await axios
            .get("http://localhost:8000/api/admin/messages/decline/" + id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then((response) => {
                let code = response.data.code;
                if (parseInt(code) !== 200) {
                    throw new Error("Hmm.. Something wrong happend!");
                }
                const newList = messages.filter((item) => item.id != id);
                setMessages(newList);
                toast.success("Declined Message");
            })
            .catch((err) => {
                toast.error(err.toString());
            });
    };

    return (
        <>
            <Navbar />
            <div className="container mt-5">
                <div className="container">
                    <div className="row">
                        <div className="col-12">
                            <div className="card">
                                <div className="card-header">
                                    <h1 className="custom__text">
                                        Messages to be approved
                                    </h1>
                                </div>
                                <div className="card-body">
                                    <div className="row">
                                        {messages.map((message) => {
                                            return (
                                                <CSSTransition
                                                    timeout={300}
                                                    key={message.id}
                                                >
                                                    <MessageRow
                                                        approve={() => approve}
                                                        decline={() => decline}
                                                        message={message}
                                                        key={message.id}
                                                    />
                                                </CSSTransition>
                                            );
                                        })}
                                        <div className="col-2 d-none d-lg-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

export default Messages;
