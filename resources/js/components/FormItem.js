import React from "react";
import ReactDOM from "react-dom";
import PropTypes from "prop-types";

const FormItem = ({ form }) => {
    return (
        <div>
            <h3 key="{form.id}">
                {form.name}
            </h3>
        </div>
    );
};

FormItem.propTypes = {
    // form: PropTypes.object.isRequired,
};

export default FormItem;
