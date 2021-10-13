import React from "react";

export default function MessageRow(props) {
    const message = props.message;
    const approve = props.approve();
    const decline = props.decline();
    console.log(message);
    return (
        <div className="col-12">
            <div
                className="container-fluid"
                className="custom__message__container"
            >
                <div className="row">
                    <div className="col-12">
                        <small className="text-muted float-right">
                            {new Date(message.created_at)
                                .toISOString()
                                .slice(0, 19)
                                .replace("T", " ")}
                        </small>
                        <div className="clearfix"></div>

                        <div>{message.body}</div>
                        <div className="float-right">
                            <a
                                onClick={() => approve(message.id)}
                                className="btn m-1 btn-success"
                            >
                                Approve
                            </a>
                            <a
                                onClick={() => decline(message.id)}
                                className="btn btn-danger"
                            >
                                Decline
                            </a>
                        </div>
                        <div className="text-muted float-left">
                            <small className="mr-1">
                                From:{" "}
                                {message.from_user.first_name +
                                    " " +
                                    message.from_user.last_name}{" "}
                            </small>
                            <small className="ml-1">
                                To:{" "}
                                {message.to_user.first_name +
                                    " " +
                                    message.to_user.last_name}{" "}
                            </small>
                        </div>
                    </div>
                    <hr className="w-100" />
                </div>
            </div>
        </div>
    );
}
