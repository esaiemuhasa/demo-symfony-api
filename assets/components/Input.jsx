
import React, {useState} from "react";

export function Input ({label, type, defaultValue, onChange, icon}) {

    const [value, setValue ] = useState()

    const handleChange = (event) => {
        setValue(event.target.value)
        if (onChange) {
            onChange(event.target.value)
        }
    }

    return (
        <div className={"custom-input"}>
            <input type={type} defaultValue={defaultValue}
                   value={value} onChange={handleChange}/>
            <label>{label}</label>
        </div>
    );
}