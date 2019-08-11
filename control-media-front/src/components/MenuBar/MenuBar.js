import useStyles from "./Style";

import React from 'react';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import IconButton from '@material-ui/core/IconButton';
import Typography from '@material-ui/core/Typography';
import InputBase from '@material-ui/core/InputBase';
// import MenuIcon from '@material-ui/icons/Menu';
// import SearchIcon from '@material-ui/icons/Search';

const MenuBar = _ => {

  const classes = useStyles();

  return (
      <div className={classes.root}>
        <AppBar position="static">
          <Toolbar>
            <IconButton
                edge="start"
                className={classes.menuButton}
                color="inherit"
                aria-label="Open drawer"
            >
           
            </IconButton>
            <Typography className={classes.title} variant="h6" noWrap>
             Controle de Mídia
            </Typography>
            <div className={classes.search}>
              <div className={classes.searchIcon}>
               
              </div>              
            </div>
          </Toolbar>
        </AppBar>
      </div>
  );
};

export default MenuBar;
