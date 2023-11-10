import React, {useEffect, useState} from "react";
import {Loading} from "../components/Loading";
import {Link} from "react-router-dom";

export function Home () {

    const [isLoading, setLoading] = useState(true)
    const [items, setItems] = useState([])

    useEffect(() => {
        fetch('/api/news/')
            .then(async resp => {
                setItems(await resp.json())
                setLoading(false)
            }).catch(() => setLoading(false))
    }, []);

    if (isLoading) {
        return <Loading/>
    }

    const news = [];

    for (let i = 0; i < items.length; i++) {
        const item = items[i]
        news.push(<News key={item.id} news={item}/> )
    }

    return (
        <div className={"home-page"}>
            <div className={"news-container"}>
                {news}
            </div>
        </div>
    );
}


function News ({news}) {
    return <article className={"home-news"}>
        <div className={"news-item-container"}>
            <h2>{news.title}</h2>
            <p>{news.content.substring(0, 250)}</p>

            <Link to={"/app/news/"+news.id+"/"} className={"btn-"}>
                <span className="fa fa-info-circle"></span> Voir plus
            </Link>
        </div>
    </article>
}

