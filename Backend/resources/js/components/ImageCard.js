import axios from "axios";
import React from "react";
import { useState, useEffect } from "react";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.min.css";

export default function ImageCard(props) {
    const image = props.image;
    const approve = props.approve();
    const decline = props.decline();

    return (
        <>
            <div className="card card__image">
                <img
                    className="card-img-top"
                    src={"./images/" + image.picture_url}
                    alt="Card image cap"
                />
                <div className="card-body">
                    <h5 className="card-title">
                        {image.user.first_name + " " + image.user.last_name}
                    </h5>
                    <p className="card-text text-muted">
                        Uploaded at:
                        {" " +
                            new Date(image.created_at)
                                .toISOString()
                                .slice(0, 19)
                                .replace("T", " ")}
                    </p>
                    <div className="d-flex justify-content-around flex-wrap">
                        <a
                            onClick={() => approve(image.id)}
                            className="btn btn-success"
                        >
                            Approve
                        </a>
                        <a
                            onClick={() => decline(image.id)}
                            className="btn btn-danger"
                        >
                            Decline
                        </a>
                    </div>
                </div>
            </div>
        </>
    );
}
