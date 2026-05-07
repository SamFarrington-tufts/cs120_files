import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

function App() {

    /*Object with value and color properties*/
    function coloredBlock(value, color){
        this.value = value;
        this.color = color;
    }

    const MyColors =[
        new coloredBlock( 7, '#f70c0c'),
        new coloredBlock( 8, '#06bd15'),
        new coloredBlock( 9, '#04a783'),
        new coloredBlock( 4, '#045ea8'),
        new coloredBlock( 5, '#1605af'),
        new coloredBlock( 6, '#7402c0'),
        new coloredBlock( 1, '#a30481'),
        new coloredBlock( 2, '#da4a86'),
        new coloredBlock( 3, '#3a0114')
    ]

    /*Template for each block object. Sets background color style, number,
      and the onClick functionality to display a popup when a block
      is clicked on*/
    function Block(props){
        return(
            <div className='block' style={{backgroundColor: props.bgcolor}}
                onClick={() => alert(props.val)}>{props.val}</div>
        )
    }

    /*Loops through every item in MyColors and creates a block for each item,
      each with a value and color*/ 
    function ColorGrid(props){
        return(
            <div className='grid'>
                {props.colorArray.map((item, i) => (
                    <Block key={i} bgcolor={item.color} val={item.value}/>
                ))}
            </div>
        )
    }

    return (
        <>
            <div className= 'app'>
                <h1>Color Grid</h1>
                <ColorGrid colorArray = {MyColors} />
            </div>
        </>
    )
}

export default App
