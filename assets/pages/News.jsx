import React from "react";
import {useParams} from "react-router-dom";

export function News () {
    const [id] = useParams()

    console.log(id)

    return <>
    </>
}