import React, { Component } from "react";
import FormItem from "./FormItem";
import ReactDOM from "react-dom";
import PropTypes from "prop-types";
import { Link } from 'react-router-dom';

const Forms = ({ forms }) => {

    return (

        <div style={userStyle}>
            {
                forms ?
                    forms.map(form => (
                        // JSON.stringify(form)
                        <div className="row" key={`form.Form.id`}>
                            <div className="well well-large">
                                <span>Form Id: {form.Form.id}</span><br />
                                <span>Form Name: {form.Form.name}</span><br />
                                <span> Response Count:{form.Form.Aggregate_metadata.response_count}</span><br />
                                <a href={'http://localhost:8100/sendemail/' + form.Form.id}>
                                    <button type="button" className="btn btn-info">Download PDF</button>
                                </a>
                                <br /><br />
                            </div>
                        </div>
                    ))
                    : ''

            }

        </div >
    );

};
const userStyle = {
    paddingTop: '2rem'
};
export default Forms;
